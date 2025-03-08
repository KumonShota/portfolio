<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
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

    public function store(StoreReviewRequest $request)
    {
        // ReviewRequestでバリデーション済みデータを取得
        $input = $request->validated();

        // 画像がアップロードされている場合、Cloudinaryでアップロードしてパスを保存
        if ($request->hasFile('image')) {
            $input['image_url'] = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        }

        // ログインユーザーのIDを付与
        $input['user_id'] = auth()->id();

        // レビューを作成
        $review = Review::create($input);

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

    public function update(UpdateReviewRequest $request, Review $review)
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
