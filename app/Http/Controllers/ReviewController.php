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
            // 既に画像が設定されている場合、URLから public_id を抽出して Cloudinary から削除
            if ($review->image_url) {
                // 例: https://res.cloudinary.com/dcp7ygojd/image/upload/v1741409865/orgquflk9bmz8cgfp50y.png
                $path = parse_url($review->image_url, PHP_URL_PATH); // "/dcp7ygojd/image/upload/v1741409865/orgquflk9bmz8cgfp50y.png"
                $segments = explode('/', $path);
                $filename = end($segments); // "orgquflk9bmz8cgfp50y.png"
                $publicId = pathinfo($filename, PATHINFO_FILENAME); // "orgquflk9bmz8cgfp50y"

                Cloudinary::destroy($publicId, ['resource_type' => 'image', 'invalidate' => true]);
            }

            // 新しい画像を Cloudinary にアップロードし、画像URLを取得
            $uploadResponse = Cloudinary::upload($request->file('image')->getRealPath());
            $data['image_url'] = $uploadResponse->getSecurePath();
        }

        $review->update($data);

        return redirect('/reviews/' . $review->id)->with('success', 'レビューを更新しました');
    }
    public function destroy(Review $review)
    {



        // 既に画像が設定されている場合、URLから public_id を抽出して Cloudinary から削除
        if ($review->image_url) {
            // 例: https://res.cloudinary.com/dcp7ygojd/image/upload/v1741409865/orgquflk9bmz8cgfp50y.png
            $path = parse_url($review->image_url, PHP_URL_PATH); // "/dcp7ygojd/image/upload/v1741409865/orgquflk9bmz8cgfp50y.png"
            $segments = explode('/', $path);
            $filename = end($segments); // "orgquflk9bmz8cgfp50y.png"
            $publicId = pathinfo($filename, PATHINFO_FILENAME); // "orgquflk9bmz8cgfp50y"

            Cloudinary::destroy($publicId, ['resource_type' => 'image', 'invalidate' => true]);
        }
        $review->delete();
        return redirect('/reviews')->with('success', 'レビューを削除しました');
    }
}
