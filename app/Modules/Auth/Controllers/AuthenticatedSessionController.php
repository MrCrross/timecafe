<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersAuthorization;
use App\Models\UsersParam;
use App\Modules\Auth\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $statusUser = (int)User::query()
            ->select('status')
            ->where('login', '=', $request->post('login'))
            ->value('status');
        if ($statusUser === 0) {
            throw ValidationException::withMessages([
                'login' => trans('auth.no_active'),
            ]);
        }
        $request->authenticate();

        $request->session()->regenerate();

        $request->user()->params = UsersParam::getByUserID($request->user()->id);
        $request->user()->isAdmin = false;
        foreach ($request->user()->params as $param) {
            if (str_contains($param, '_edit')) {
                $request->user()->isAdmin = true;
                break;
            }
        }
        UsersAuthorization::query()->insert([
           'user_id' => $request->user()->id,
           'is_admin' => $request->user()->isAdmin,
           'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($request->user()->isAdmin) {
            return redirect()->route('admin.index');
        }
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $isAdmin = $request->user()->isAdmin;
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $isAdmin ? redirect()->route('login') : redirect()->route('welcome');
    }
}
