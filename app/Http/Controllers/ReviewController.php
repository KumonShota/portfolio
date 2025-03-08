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
        // バリデーション済みのデータを取得
        $validated = $request->validated();

        // ネストされた'review'配列を展開
        $data = $validated['review'];

        // 画像がアップロードされている場合はCloudinaryにアップロード
        if ($request->hasFile('image')) {
            $uploadResponse = Cloudinary::upload($request->file('image')->getRealPath());
            $data['image_url'] = $uploadResponse->getSecurePath();
            $data['image_public_id'] = $uploadResponse->getPublicId();
        }

        // ログインユーザーのIDを追加
        $data['user_id'] = auth()->id();

        // レビュー作成
        $review = Review::create($data);

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
        // バリデーション済みのデータから 'review' 配列を取得
        $validated = $request->validated();
        $data = $validated['review'];

        // 画像がアップロードされている場合
        if ($request->hasFile('image')) {
            // 既に画像が設定されている場合、Cloudinaryから削除
            if ($review->image_public_id) {
                Cloudinary::destroy($review->image_public_id);
            }

            // 新しい画像をCloudinaryにアップロードし、画像URLとpublic idを取得
            $uploadResponse = Cloudinary::upload($request->file('image')->getRealPath());
            $data['image_url'] = $uploadResponse->getSecurePath();
            $data['image_public_id'] = $uploadResponse->getPublicId();
        }

        $review->update($data);

        return redirect('/reviews/' . $review->id)->with('success', 'レビューを更新しました');
    }
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect('/reviews')->with('success', 'レビューを削除しました');
    }
}
