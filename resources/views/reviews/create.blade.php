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
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value=" {{ old('post.body') }}" />
                <p class="title__error">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="ここに内容を入力">{{ old('post.body') }}</textarea>
                <p class="body__error">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="保存" />
        </form>
        <div class="footer">
            <a href="/">一覧へ戻る</a>
        </div>
    </body>

</html>
</form>
</body>
</x-app-layout>

</html>