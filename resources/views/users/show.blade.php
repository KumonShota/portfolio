<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>users</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,600" rel="stylesheet">
</head>

<h1>{{ $user->name }} のプロフィール</h1>

<!-- プロフィール画像 -->
@if ($user->image)
<img src="{{ asset('storage/' . $user->image) }}" alt="プロフィール画像" width="150">
@else
<p>プロフィール画像なし</p>
@endif

<p>性別: {{ $user->sex ?? '未設定' }}</p>

<!-- フォロー・フォロワー情報 -->
<p>フォロー中: {{ $user->following->count() }} 人</p>
<p>フォロワー: {{ $user->followers->count() }} 人</p>

<!-- フォロー・フォロワーボタン -->
@if (Auth::check() && Auth::id() !== $user->id)
@if (Auth::user()->following->contains($user->id))
<form action="{{ route('users.unfollow', $user->id) }}" method="POST">
    @csrf
    <button type="submit">フォロー解除</button>
</form>
@else
<form action="{{ route('users.follow', $user->id) }}" method="POST">
    @csrf
    <button type="submit">フォロー</button>
</form>
@endif
@endif

<h2>投稿したレビュー</h2>
<ul>
    @foreach($user->reviews as $review)
    <li>{{ $review->title }} - {{ $review->content }}</li>
    @endforeach
</ul>

<a href="{{ route('reviews.index') }}">← レビュー一覧に戻る</a>