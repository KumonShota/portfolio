<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>users</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,600" rel="stylesheet">
</head>

<body class="bg-yellow-50">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <!-- ユーザー名 -->
        <h1 class="text-2xl font-bold text-red-600 text-center border-b-2 border-red-300 pb-2">
            👤 {{ $user->name }} のプロフィール
        </h1>

        <!-- プロフィール画像 -->
        <div class="text-center mt-4">
            @if ($user->image)
            <img src="{{ asset('storage/' . $user->image) }}" alt="プロフィール画像"
                class="w-32 h-32 rounded-full mx-auto shadow">
            @else
            <p class="text-gray-600">📷 プロフィール画像なし</p>
            @endif
        </div>

        <!-- 基本情報 -->
        <p class="mt-4 text-lg text-gray-700">🧑 性別: <span class="font-bold">{{ $user->sex ?? '未設定' }}</span></p>

        <!-- フォロー・フォロワー数 -->
        <div class="flex justify-center space-x-6 mt-4">
            <p class="text-lg text-red-500 font-semibold">👥 フォロー中: {{ $user->following->count() }} 人</p>
            <p class="text-lg text-red-500 font-semibold">📢 フォロワー: {{ $user->followers->count() }} 人</p>
        </div>

        <!-- フォローボタン -->
        @if (Auth::check() && Auth::id() !== $user->id)
        <div class="text-center mt-4">
            @if (Auth::user()->following->contains($user->id))
            <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-gray-400 text-white font-bold py-2 px-6 rounded-full hover:bg-gray-500 transition duration-300">
                    フォロー解除
                </button>
            </form>
            @else
            <form action="{{ route('users.follow', $user->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white font-bold py-2 px-6 rounded-full hover:bg-red-600 transition duration-300">
                    フォロー
                </button>
            </form>
            @endif
        </div>
        @endif

        <!-- 投稿したレビュー -->
        <h2 class="text-xl font-semibold text-red-500 mt-6 border-b-2 border-red-300 pb-2">📝 投稿したレビュー</h2>
        @if ($user->reviews->count() > 0)
        <ul class="mt-4 space-y-4">
            @foreach($user->reviews as $review)
            <li class="p-4 bg-yellow-100 rounded-lg shadow">
                <span class="text-red-600 font-semibold">🍜 {{ $review->title }}</span>
                <p class="text-gray-700 mt-1">{{ Str::limit($review->content, 50) }}</p>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-gray-600 mt-4 text-center">まだレビューは投稿されていません。</p>
        @endif

        <!-- 戻るボタン -->
        <div class="mt-6 text-center">
            <a href="{{ route('reviews.index') }}" class="text-red-500 font-semibold hover:underline">← レビュー一覧に戻る</a>
        </div>
    </div>
</body>