<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Review;

class FavoriteController extends Controller
{

    public function store($review_id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $review = Review::findOrFail($review_id);

        if ($review->isFavoritedByUser()) {
            return response()->json(['message' => 'Already favorited'], 400);
        }

        Favorite::create([
            'user_id' => $user->id,
            'review_id' => $review->id,
        ]);

        return response()->json(['message' => 'Favorited'], 200);
    }

    public function destroy($review_id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $favorite = Favorite::where('user_id', $user->id)->where('review_id', $review_id)->first();

        if (!$favorite) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Unfavorited'], 200);
    }
}
