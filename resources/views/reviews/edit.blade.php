<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-center text-red-600">🍜 ラーメン好きのための口コミアプリ 🍜</h1>
    </x-slot>

    <body class="bg-yellow-50">
        <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-red-500 border-b-2 border-red-300 pb-2">✏️ 口コミを編集</h2>

            <!-- 保存済みの画像を表示 -->
            @if($review->image)
            <div class="mb-4">
                <label class="block text-red-500 font-semibold">現在の画像</label>
                <img src="{{ asset('storage/' . $review->image) }}" alt="保存済み画像" class="w-full max-w-xs">
            </div>
            @endif

            <form action="/reviews/{{ $review->id }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-4">
                @csrf
                @method('PUT')

                <!-- タイトル入力 -->
                <div>
                    <label class="block text-red-500 font-semibold">🍜 タイトル</label>
                    <input type="text" name="review[title]" value="{{ old('review.title', $review->title) }}"
                        class="w-full p-2 border-2 border-yellow-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400">
                    <p class="text-red-500 text-sm">{{ $errors->first('review.title') }}</p>
                </div>

                <!-- 本文入力 -->
                <div>
                    <label class="block text-red-500 font-semibold">📝 本文</label>
                    <textarea name="review[body]" rows="4"
                        class="w-full p-2 border-2 border-yellow-300 rounded focus:outline-none focus:ring-2 focus:ring-red-400">{{ old('review.body', $review->body) }}</textarea>
                    <p class="text-red-500 text-sm">{{ $errors->first('review.body') }}</p>
                </div>

                <!-- 画像アップロード -->
                <div>
                    <label class="block text-red-500 font-semibold">📷 画像をアップロード</label>
                    <input type="file" name="image" class="w-full p-2 border-2 border-yellow-300 rounded bg-white">
                    <p class="text-red-500 text-sm">{{ $errors->first('image') }}</p>
                </div>

                <!-- 送信ボタン -->
                <div class="text-center">
                    <input type="submit" value="✅ 保存する"
                        class="bg-red-500 text-white font-bold py-2 px-6 rounded-full hover:bg-red-600 transition duration-300">
                </div>
            </form>
        </div>
    </body>
</x-app-layout>