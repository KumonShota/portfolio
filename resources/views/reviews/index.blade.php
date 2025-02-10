<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,700" rel="stylesheet">
</head>

<body>
    <h1>Review Name</h1>
    <div class='posts'>
        @foreach($posts as $post)
        <div class='post'>
            <h2 class='title'>
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            </h2>
            <p class='body'>{{ $post->body }}</p>
        </div>
        @endforeach
    </div>
    <a href='/posts/create'>口コミを投稿する</a>

</html>