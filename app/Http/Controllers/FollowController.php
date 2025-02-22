<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        Auth::user()->following()->attach($user->id);
        return back()->with('success', 'フォローしました！');
    }

    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user->id);
        return back()->with('success', 'フォローを解除しました。');
    }
}
