<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,700" rel="stylesheet">
</head>

<body>
    <a href='/posts/create'>口コミを投稿する </a>
    <h1>口コミ一覧</h1>
    <p style="text-align: right">
        <a href='/posts/mypage'>マイページ</a>
    </p>
    <div class='posts'>
        @foreach($posts as $post)
        <div class='post'>
            <h2 class='title'>
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>


            </h2>
            <p class='body'>{{ $post->body }}</p>
            <form action="/posts/{{$post->id}}" id="form\{{$post->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id}})">口コミを削除する</button>
            </form>
        </div>
        @endforeach
    </div>


    <script>
        function deletePost(id) {
            'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>

</html>