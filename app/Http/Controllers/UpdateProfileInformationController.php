<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateProfileInformationController extends Controller
{
    public function edit()
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {
        $attr = $request->validate([
            'name' => 'string|min:3|required',
            'email' => 'email|min:3|max:190|required',
            'username' => 'string|alpha_num|required|unique:users,username,' . auth()->id(),
        ]);

        auth()->user()->update($attr);

        return redirect()
            ->route('profile', auth()->user()->username)
            ->with('message', 'Your profile has been updated.');
    }
}
