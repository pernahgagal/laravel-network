<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowingController extends Controller
{
    public function index(User $user, $follows)
    {
        if($follows !== 'following' && $follows !== 'followers') {
            return abort(404);
        }

        return view('user.follow', [
            'follow' => $follows == 'following' ? $user->follows : $user->followers,
            'user' => $user
        ]);
    }

    public function store(Request $request, User $user)
    {
        Auth::user()->hasFollow($user)
            ? Auth::user()->unfollow($user)
            : Auth::user()->follow($user);

        return back()->with("success", "You are follow the user.");
    }
}
