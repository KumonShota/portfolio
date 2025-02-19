<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>region</title>
</head>

<body>
    <h1>{{ $region->name }} のお店一覧</h1>

    @if ($stores->count() > 0)
    <ul>
        @foreach($stores as $store)
        <li>{{ $store->name }}</li>
        @endforeach
    </ul>
    @else
    <p>この地方にはまだ登録されたお店がありません。</p>
    @endif

    <a href="{{ route('regions.index') }}">← 地方一覧に戻る</a>

</body>

</html>