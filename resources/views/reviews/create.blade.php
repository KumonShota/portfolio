<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
</head>

<x-app-layout>
    <x-slot name="header">
        口コミを投稿する
    </x-slot>

    <body>
        <h1>口コミタイトル</h1>
        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="review[store_id]" value="{{ $store->id }}">

            <div class="store-info">
                <h2>選択したお店</h2>
                <p>店舗名: {{ $store->name }}</p>
                <p>場所: {{ $store->place ?? '情報なし' }}</p>
            </div>

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

            <div class="image">
                <h2>画像をアップロード</h2>
                <input type="file" name="review[image]" accept="image/*">
                <p class="image__error">{{ $errors->first('review.image') }}</p>
            </div>

            <input type="submit" value="保存" />
        </form>

        <div class="footer">
            <a href="{{ route('stores.index') }}">お店選択に戻る</a>
        </div>
    </body>
</x-app-layout>

</html>