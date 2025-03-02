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
        <h2>投稿者の情報</h2>
        <p>投稿者名: <a href="{{ route('users.show', $review->user->id) }}">
                {{ $review->user->name }}
            </a>
        </p>

        <h2>お店の情報</h2>
        <p>店舗名: {{ $review->store->name }}</p>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        @if(Auth::check() && Auth::id() === $review->user_id)
        <div class="edit">
            <a href="/reviews/{{ $review->id }}/edit">口コミを編集する</a>
        </div>
        @endif

        <hr>

        <!-- コメント一覧 -->
        <h2>コメント一覧</h2>
        @if ($review->comments->count() > 0)
        <ul>
            @foreach($review->comments as $comment)
            <li>
                <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                <small>({{ $comment->created_at->format('Y-m-d H:i') }})</small>

                <!-- 返信フォーム -->
                <form action="{{ route('comments.store', $review) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <input type="text" name="content" placeholder="返信を書く..." required>
                    <button type="submit">返信</button>
                </form>

                <!-- 削除ボタン（本人のみ） -->
                @if(Auth::check() && Auth::id() === $comment->user_id)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
                @endif

                <!-- 返信一覧 -->
                @if ($comment->replies->count() > 0)
                <ul>
                    @foreach($comment->replies as $reply)
                    <li>
                        <strong>{{ $reply->user->name }}</strong>: {{ $reply->content }}
                        <small>({{ $reply->created_at->format('Y-m-d H:i') }})</small>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
        @else
        <p>コメントはまだありません。</p>
        @endif

        <hr>
        <!-- コメント投稿フォーム -->
        @if(Auth::check())
        <h2>コメントを投稿</h2>
        <form action="{{ route('comments.store', $review) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" required></textarea>
            <button type="submit">送信</button>
        </form>
        @else
        <p><a href="{{ route('login') }}">ログイン</a>するとコメントを投稿できます。</p>
        @endif

    </body>
</x-app-layout>

</html>