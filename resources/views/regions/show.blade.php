<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>region</title>
</head>

<body class="bg-yellow-50">
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-red-600 text-center border-b-2 border-red-300 pb-2">
            🍜 {{ $region->name }} のお店一覧 🍜
        </h1>

        @if ($stores->count() > 0)
        <ul class="mt-4 space-y-4">
            @foreach($stores as $store)
            <li class="p-4 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200 transition duration-300">
                <span class="text-red-600 font-semibold">🏠 {{ $store->name }}</span>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-gray-600 text-center mt-4">🚧 この地方にはまだ登録されたお店がありません。</p>
        @endif

        <!-- 戻るボタン -->
        <div class="mt-6 text-center">
            <a href="{{ route('regions.index') }}" class="text-red-500 font-semibold hover:underline">← 地方一覧に戻る</a>
        </div>
    </div>
</body>


</body>

</html>