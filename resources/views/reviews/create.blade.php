<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
</head>

<x-app-layout>
    <x-slot name="header">
        ラーメン好きのための口コミアプリ
    </x-slot>

    <body>
        <h1>口コミタイトル</h1>
        <form action="/reviews" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="review[title]" placeholder="タイトル" value="{{ old('review.title') }}" />
                <p class="title__error">{{ $errors->first('review.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="review[body]" placeholder="ここに内容を入力">{{ old('review.body') }}</textarea>
                <p class="body__error">{{ $errors->first('review.body') }}</p>
            </div>
            <input type="submit" value="保存" />
        </form>
        <div class="footer">
            <a href="/">一覧へ戻る</a>
        </div>
    </body>

</x-app-layout>

</html>