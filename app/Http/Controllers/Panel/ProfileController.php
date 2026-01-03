<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Users\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('panel.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            // avatar.jpg
            $ext = $file->getClientOriginalExtension();
            $file_name = auth()->user()->id . '_' . time() . '.' . $ext;
            $file->storeAs('images/users', $file_name, 'public_files');
            $data['profile'] = $file_name;
        }

        auth()->user()->update(
            $data
        );

        session()->flash('status', 'اطلاعات کاربری شما ویرایش شد!');
        return back();
    }
}
