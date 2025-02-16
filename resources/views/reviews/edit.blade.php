<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>edit</title>
</head>

<x-app-layout>
    <x-slot name="header">
        ラーメン好きのための口コミアプリ
    </x-slot>

    <body>
        <h1 class="title">口コミを編集</h1>
        <div class="content">
            <form action="/reviews/{{ $review->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__title'>
                    <h2>タイトル</h2>
                    <input type='text' name='review[title]' value="{{ old('review.title', $review->title) }}">
                    <p class="title__error">{{ $errors->first('review.title') }}</p>
                </div>
                <div class='content__body'>
                    <h2>本文</h2>
                    <textarea name='review[body]'>{{ old('review.body', $review->body) }}</textarea>
                    <p class="body__error">{{ $errors->first('review.body') }}</p>
                </div>
                <input type="submit" value="保存">
            </form>
        </div>
    </body>
</x-app-layout>

</html>