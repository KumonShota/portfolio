<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($review_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        // すでにお気に入りされているかチェック
        if (Favorite::where('user_id', $user->id)->where('review_id', $review_id)->exists()) {
            return redirect()->back()->with('error', 'すでにお気に入りに登録されています。');
        }

        Favorite::create([
            'user_id' => $user->id,
            'review_id' => $review_id,
        ]);

        return redirect()->back()->with('success', 'お気に入りに追加しました！');
    }

    public function destroy($review_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        $favorite = Favorite::where('user_id', $user->id)->where('review_id', $review_id)->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'お気に入りを解除しました。');
        }

        return redirect()->back()->with('error', 'お気に入りが見つかりませんでした。');
    }
}
