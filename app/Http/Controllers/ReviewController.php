<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use App\Models\Region;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        $regions = Region::all();

        return view('reviews.index', compact('reviews', 'regions'));
    }




    public function create(Request $request)
    {
        $store_id = $request->query('store_id');
        $store = Store::find($store_id);

        if (!$store) {
            return redirect()->route('stores.index')->with('error', 'お店を選択してください');
        }

        return view('reviews.create', compact('store'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'review.title' => 'required|string|max:255',
            'review.body' => 'required|string',
            'review.store_id' => 'required|exists:stores,id',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:10240',
        ]);

        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();


        $input = $request['review'];

        $review = Review::create([
            'title' => $request->input('review.title'),
            'body' => $request->input('review.body'),
            'store_id' => $request->input('review.store_id'),
            'user_id' => auth()->id(),
            'stars' => $request->input('review.stars', 0),
            'image_url' => $image_url,
        ]);

        return redirect()->route('reviews.index')->with('success', 'レビューを投稿しました！');
    }

    public function show(Review $review)
    {
        return view('reviews.show', compact('review'))->with(['review' => $review]);
    }

    public function edit(Review $review)
    {
        return view('reviews.edit')->with(['review' => $review]);
    }

    public function update(ReviewRequest $request, Review $review)
    {
        $input = $request->validated();
        $review->update($input);

        return redirect('/reviews/' . $review->id)->with('success', 'レビューを更新しました');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect('/reviews')->with('success', 'レビューを削除しました');
    }
}
