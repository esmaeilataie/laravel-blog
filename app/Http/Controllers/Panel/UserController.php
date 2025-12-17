<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Users\CreateUserRequest;
use App\Http\Requests\Panel\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate();
        return view('panel.users.index', [
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('panel.users.create');
    }


    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make('password');
        User::create($validated);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('panel.users.edit', [
            'user' => $user
        ]);
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route('users.index');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
