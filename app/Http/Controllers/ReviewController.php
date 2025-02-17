<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Review $review)
    {
        return view('reviews.index')->with(['reviews' => $review->all()]);
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(ReviewRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $input['store_id'] = $request->store_id ?? null;

        $review = Review::create($input);

        return redirect('/reviews/' . $review->id)->with('success', 'レビューを投稿しました');
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
