<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsersParam;
use App\Modules\Auth\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if ($request->user()->isAdmin) {
            return redirect()->route('admin.index');
        }
        return redirect()->intended(RouteServiceProvider::HOME);
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
