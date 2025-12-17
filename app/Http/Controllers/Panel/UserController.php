<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('panel.users.index', [
            'users' => $users
        ]);
    }


    public function create()
    {
        return view('panel.users.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'persian_alpha', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'string', 'unique:' . User::class],
            'mobile' => ['required', 'string', 'max:255', 'unique:' . User::class, 'ir_mobile'],
            'role' => ['required', Rule::in(['user', 'author', 'admin'])]
        ]);

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


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'persian_alpha', 'max:255'],
            'email' => ['required', 'email', 'lowercase', 'string',
                Rule::unique('users', 'email')->ignore($user->id)],
            'mobile' => ['required', 'string', 'max:255', 'ir_mobile',
                Rule::unique('users', 'mobile')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'author', 'admin'])]
        ]);

        $user->update($validated);
        return redirect()->route('users.index');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
