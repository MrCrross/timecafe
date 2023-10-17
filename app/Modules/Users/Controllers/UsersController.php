<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersParam;
use App\Modules\Users\Requests\UsersStoreRequest;
use App\Modules\Users\Requests\UsersUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::query()
            ->orderBy('id', 'desc')
            ->get();

        return response()->view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $params = UsersParam::selectRaw('id as value, CONCAT(man_name, " (", name, ")") as label')
            ->orderBy('name')
            ->get();

        return response()->view('users.create', [
            'params' => $params,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersStoreRequest $request): RedirectResponse
    {
        $fields = [
            'fio' => $request->post('fio'),
            'login' => $request->post('login'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'status' => 1,
        ];

        $userID = User::restore(0, $fields);

        foreach ($request->post('params') as $param) {
            User::addParam($userID, $param);
        }

        return Redirect::route('users.create')->with('status', 'user-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $user = User::selectRaw('
            users.id,
            users.fio,
            users.login,
            users.email,
            users.created_at,
            IF(status = 1, "Активна", "Отключена") as status_name
        ')
            ->find($id);

        return response()->view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $user = User::with('userParams')
            ->find($id);
        $params = UsersParam::selectRaw('id as value, CONCAT(man_name, " (", name, ")") as label')
            ->orderBy('name')
            ->get();

        return response()->view('users.edit', [
            'user' => $user,
            'params' => $params,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsersUpdateRequest $request, string $id): RedirectResponse
    {
        $fields = [
            'status' => $request->post('status'),
        ];

        if ($request->has('login')) {
            $request->validate([
                'login' => ['string', 'max:255', Rule::unique(User::class, 'login')->ignore($id)],
                'email' => ['email', 'max:255', Rule::unique(User::class, 'email')->ignore($id)],
            ]);
            $fields['login'] = $request->post('login');
            $fields['email'] = $request->post('email');
            $fields['fio'] = $request->post('fio');
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $fields['password'] = Hash::make($request->post('password'));
        }

        User::restore($id, $fields);

        if ($request->has('params')) {
            $currentParams = User::getParams($id);
            $newParams = $request->post('params');
            $addParams = array_diff($newParams, $currentParams);
            $deleteParams = array_diff($currentParams, $newParams);

            if (!empty($deleteParams)) {
                User::deleteParams($id, $deleteParams);
            }
            if (!empty($addParams)) {
                foreach ($addParams as $param) {
                    User::addParam($id, $param);
                }
            }
        }

        return Redirect::route('users.edit', $id)->with('status', 'user-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        User::deleteByID($id);

        return redirect()->route('users.index');
    }
}
