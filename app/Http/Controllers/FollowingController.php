<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function __invoke(User $user, $follows)
    {
        if($follows !== 'following' && $follows !== 'followers') {
            return abort(404);
        }

        return view('user.follow', [
            'follow' => $follows == 'following' ? $user->follows : $user->followers,
            'user' => $user
        ]);
    }
}
