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
        お店一覧
    </x-slot>

    <h1>お店を選択してください</h1>
    <ul>
        @foreach($stores as $store)
        <li>
            <a href="{{ route('reviews.create', ['store_id' => $store->id]) }}">
                {{ $store->name }} （{{ $store->place }}）
            </a>
        </li>
        @endforeach
    </ul>

    <div class="footer">
        <a href="/">ホームに戻る</a>
    </div>
</x-app-layout>