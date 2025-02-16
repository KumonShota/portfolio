<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reviews</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,600" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        ラーメン好きのための口コミアプリ
    </x-slot>

    <body>
        <h1 class="title">
            {{ $review->title }}
        </h1>
        <div class="content">
            <div class="content__review">
                <h3>本文</h3>
                <p>{{ $review->body }}</p>
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class="edit">
            <a href="/reviews/{{ $review->id }}/edit">口コミを編集する</a>
        </div>
    </body>
</x-app-layout>

</html>