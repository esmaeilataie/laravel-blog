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
        return view('panel.users.index');
    }


    public function create()
    {
        return view('panel.users.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'persian_alpha','max:255'],
            'email' => ['required', 'email', 'lowercase', 'string', 'unique:'.User::class],
            'mobile' => ['required','string', 'max:255', 'unique:'.User::class,'ir_mobile'],
            'role' => ['required', Rule::in(['user', 'author', 'admin'])]
        ]);

        $validated['password'] = Hash::make('password');
        User::create($validated);
        return redirect()->route('users.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        return view('panel.users.edit');
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
