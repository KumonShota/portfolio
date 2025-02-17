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
        ラーメン好きのための口コミアプリ
    </x-slot>

    <body>
        <a href='/reviews/create'>口コミを投稿する</a>
        <h1>口コミ一覧</h1>
        <p style="text-align: right">
            <a href='/reviews/mypage'>マイページ</a>
        </p>
        <div class='reviews'>
            @foreach($reviews as $review)
            <div class='review'>
                <h2 class='title'>{{$review->title}}
                    <a href="/reviews/{{ $review->id }}">詳細</a>
                </h2>
                <p class='body'>{{ $review->body }}</p>
                <div class="favorite-section">
                    @if($review->isFavoritedByUser())
                    <form action="{{ route('reviews.unfavorite', ['review' => $review->id]) }}" method="POST">
                        @csrf
                        <button type="submit">💔 お気に入り解除</button>
                    </form>
                    @else
                    <form action="{{ route('reviews.favorite', ['review' => $review->id]) }}" method="POST">
                        @csrf
                        <button type="submit">⭐ お気に入り</button>
                    </form>
                    @endif
                </div>

                <p>お気に入り数: {{ $review->favorites->count() }}</p>
                <form action="/reviews/{{ $review->id }}" id="form_{{ $review->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteReview({{ $review->id }})">口コミを削除する</button>
                </form>
            </div>
            @endforeach
        </div>

        <script>
            function deleteReview(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</x-app-layout>

</html>