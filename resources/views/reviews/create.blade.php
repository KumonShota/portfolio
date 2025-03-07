<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-center text-red-600">🍜 口コミを投稿する 🍜</h1>
    </x-slot>

    <body class="bg-yellow-50">
        <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-red-500 border-b-2 border-red-300 pb-2">口コミタイトル</h2>

            <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-4">
                @csrf
                <input type="hidden" name="review[store_id]" value="{{ $store->id }}">

                <!-- 店舗情報 -->
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-red-500">選択したお店</h2>
                    <p class="text-gray-700">🏠 店舗名: <span class="font-bold">{{ $store->name }}</span></p>
                    <p class="text-gray-700">📍 場所: <span class="font-bold">{{ $store->place ?? '情報なし' }}</span></p>
                </div>

                <!-- タイトル入力 -->
                <div>
                    <label class="block text-red-500 font-semibold">🍜 タイトル</label>
                    <input type="text" name="review[title]" placeholder="例: 濃厚豚骨が最高！" value="{{ old('review.title') }}"
                        class="w-full p-2 border-2 border-yellow-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400">
                    <p class="text-red-500 text-sm">{{ $errors->first('review.title') }}</p>
                </div>

                <!-- 内容入力 -->
                <div>
                    <label class="block text-red-500 font-semibold">📝 口コミ内容</label>
                    <textarea name="review[body]" placeholder="ここに内容を入力" rows="4"
                        class="w-full p-2 border-2 border-yellow-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400">{{ old('review.body') }}</textarea>
                    <p class="text-red-500 text-sm">{{ $errors->first('review.body') }}</p>
                </div>

                <!-- 画像アップロード -->
                <div>
                    <label class="block text-red-500 font-semibold">📷 画像をアップロード</label>
                    <input type="file" name="image" class="w-full p-2 border-2 border-yellow-300 rounded bg-white">
                    <p class="text-red-500 text-sm">{{ $errors->first('image') }}</p>
                </div>

                <!-- 送信ボタン -->
                <div class="text-center">
                    <input type="submit" value="🍜 投稿する"
                        class="bg-red-500 text-white font-bold py-2 px-6 rounded-full hover:bg-red-600 transition duration-300">
                </div>
            </form>

            <!-- フッター -->
            <div class="mt-6 text-center">
                <a href="{{ route('stores.index') }}" class="text-red-500 hover:underline">← お店選択に戻る</a>
            </div>
        </div>
    </body>
</x-app-layout>

</html>