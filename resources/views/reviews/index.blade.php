<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,700" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-center text-red-600">ラーメン好きのための口コミアプリ</h1>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <!-- 地方一覧セクション -->
        <section class="mb-8">
            <h1 class="text-2xl font-semibold mb-4">地方一覧</h1>
            <ul class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($regions as $region)
                <li class="bg-white rounded shadow p-4 hover:bg-red-50 transition">
                    <a href="{{ route('regions.show', $region->id) }}" class="text-lg text-red-500 hover:text-red-700">
                        {{ $region->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </section>
        <!-- 口コミ投稿リンク -->
        <div class="mb-8">
            <a href='/reviews/create' class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded shadow">
                口コミを投稿する
            </a>
        </div>
        <!-- 口コミ一覧セクション -->
        <section>
            <h1 class="text-2xl font-semibold mb-4">口コミ一覧</h1>
            <div class="grid grid-cols-1 gap-6">
                @foreach($reviews as $review)
                <div class="review bg-white rounded-lg shadow p-6">
                    <h2 class="title text-xl font-bold mb-2">
                        {{ $review->title }}
                        - <a href="{{ route('users.show', $review->user->id) }}" class="text-red-500 hover:underline">
                            {{ $review->user->name }}
                        </a>
                        <span class="text-sm text-gray-600">（店舗名: {{ $review->store->name }}）</span>
                    </h2>
                    <p class="body text-gray-700 mb-4">{{ $review->body }}</p>
                    @if($review->image_path)
                    <img src="{{ asset('storage/' . $review->image_path) }}" alt="レビュー画像" class="max-w-xs rounded mb-4">
                    @endif
                    <div class="flex items-center justify-between">
                        <a href="/reviews/{{ $review->id }}" class="text-blue-500 hover:underline">
                            詳細を見る
                        </a>
                        <div class="favorite-section flex items-center">
                            @if($review->isFavoritedByUser())
                            <form action="{{ route('reviews.unfavorite', ['review' => $review->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-yellow-500 text-xl">:星1:</button>
                            </form>
                            @else
                            <form action="{{ route('reviews.favorite', ['review' => $review->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-400 text-xl hover:text-yellow-500">☆</button>
                            </form>
                            @endif
                            <p class="ml-2 text-gray-600">{{ $review->favorites->count() }}</p>
                        </div>
                    </div>
                    <!-- 投稿者のみ削除ボタン -->
                    @if(Auth::check() && Auth::id() === $review->user_id)
                    <form action="/reviews/{{ $review->id }}" id="form_{{ $review->id }}" method="post" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteReview({{ $review->id }})" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">
                            口コミを削除する
                        </button>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
        </section>
    </div>
    <script>
        function deleteReview(id) {
            'use strict'
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>

リアクションする

返信









</html>