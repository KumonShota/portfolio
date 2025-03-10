<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-center text-red-600">🍜 ラーメン好きのための口コミアプリ 🍜</h1>
    </x-slot>

    <body class="bg-yellow-50">
        <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <!-- 口コミタイトル -->
            <h2 class="text-2xl font-semibold text-red-500 border-b-2 border-red-300 pb-2">{{ $review->title }}</h2>

            <!-- 口コミ本文 -->
            <div class="mt-4 bg-yellow-100 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-red-500">📝 本文</h3>
                <p class="text-gray-700 mt-2">{{ $review->body }}</p>
            </div>

            <!-- 口コミ画像 -->
            <div class="mt-4">
                <img src="{{ $review->image_url }}" alt="画像が読み込めません。" class="w-full h-auto rounded-lg shadow">
            </div>

            <!-- 投稿者情報 -->
            <div class="mt-6 bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-red-500">👤 投稿者の情報</h3>
                <p class="text-gray-700">
                    投稿者名:
                    <a href="{{ route('users.show', $review->user->id) }}" class="text-red-500 font-semibold hover:underline">
                        {{ $review->user->name }}
                    </a>
                </p>
            </div>

            <!-- お店情報 -->
            <div class="mt-4 bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-red-500">🏠 お店の情報</h3>
                <p class="text-gray-700">店舗名: <span class="font-bold">{{ $review->store->name }}</span></p>
            </div>

            <!-- 戻るボタン -->
            <div class="mt-6 text-center">
                <a href="/" class="text-red-500 hover:underline">← 戻る</a>
            </div>

            <!-- 編集リンク（投稿者のみ表示） -->
            @if(Auth::check() && Auth::id() === $review->user_id)
            <div class="mt-4 text-center">
                <a href="/reviews/{{ $review->id }}/edit"
                    class="bg-red-500 text-white font-bold py-2 px-6 rounded-full hover:bg-red-600 transition duration-300">
                    ✏️ 口コミを編集する
                </a>
            </div>
            @endif

            <hr class="my-6 border-red-300">

            <!-- コメント一覧 -->
            <h2 class="text-xl font-semibold text-red-500">💬 コメント一覧</h2>

            @if ($review->comments->count() > 0)
            <ul class="mt-4 space-y-4">
                @foreach($review->comments as $comment)
                <li class="p-4 bg-white rounded-lg shadow">
                    <strong class="text-red-500">{{ $comment->user->name }}</strong>:
                    <span class="text-gray-700">{{ $comment->content }}</span>
                    <small class="text-gray-500">({{ $comment->created_at->format('Y-m-d H:i') }})</small>

                    <!-- 返信フォーム -->
                    <form action="{{ route('comments.store', $review) }}" method="POST" class="mt-2 flex space-x-2">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <input type="text" name="content" placeholder="返信を書く..."
                            class="flex-1 p-2 border-2 border-yellow-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400" required>
                        <button type="submit"
                            class="bg-red-500 text-white font-bold py-1 px-4 rounded-full hover:bg-red-600 transition duration-300">
                            返信
                        </button>
                    </form>

                    <!-- 削除ボタン（本人のみ表示） -->
                    @if(Auth::check() && Auth::id() === $comment->user_id)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-red-500 hover:text-red-700 font-semibold text-sm">
                            🗑 削除
                        </button>
                    </form>
                    @endif

                    <!-- 返信一覧 -->
                    @if ($comment->replies->count() > 0)
                    <ul class="mt-2 pl-4 border-l-2 border-yellow-300 space-y-2">
                        @foreach($comment->replies as $reply)
                        <li class="p-2 bg-yellow-100 rounded">
                            <strong class="text-red-500">{{ $reply->user->name }}</strong>:
                            <span class="text-gray-700">{{ $reply->content }}</span>
                            <small class="text-gray-500">({{ $reply->created_at->format('Y-m-d H:i') }})</small>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-600 mt-2">コメントはまだありません。</p>
            @endif

            <hr class="my-6 border-red-300">

            <!-- コメント投稿フォーム -->
            @if(Auth::check())
            <h2 class="text-xl font-semibold text-red-500">✏️ コメントを投稿</h2>
            <form action="{{ route('comments.store', $review) }}" method="POST" class="mt-4 space-y-2">
                @csrf
                <textarea name="content" rows="3" required
                    class="w-full p-2 border-2 border-yellow-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400"></textarea>
                <div class="text-right">
                    <button type="submit"
                        class="bg-red-500 text-white font-bold py-2 px-6 rounded-full hover:bg-red-600 transition duration-300">
                        送信
                    </button>
                </div>
            </form>
            @else
            <p class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-red-500 font-semibold hover:underline">
                    ログイン
                </a>するとコメントを投稿できます。
            </p>
            @endif
        </div>
    </body>
</x-app-layout>