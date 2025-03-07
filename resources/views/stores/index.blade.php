<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Store</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:500,700" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-center text-red-600">🍜 お店一覧 🍜</h1>
    </x-slot>

    <body class="bg-yellow-50">
        <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-xl font-semibold text-red-500 border-b-2 border-red-300 pb-2 text-center">
                お店を選択してください
            </h2>

            <!-- お店リスト -->
            <ul class="mt-4 space-y-4">
                @foreach($stores as $store)
                <li class="p-4 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200 transition duration-300">
                    <a href="{{ route('reviews.create', ['store_id' => $store->id]) }}"
                        class="text-red-600 font-semibold hover:underline">
                        🍜 {{ $store->name }} （📍{{ $store->place }}）
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- ホームに戻る -->
            <div class="mt-6 text-center">
                <a href="/" class="text-red-500 font-semibold hover:underline">← ホームに戻る</a>
            </div>
        </div>
    </body>
</x-app-layout>