<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Review</title>
</head>

<body>
    <h1>口コミタイトル</h1>
    <form action="/posts" method="POST">
        @csrf
        <div class="title">
            <h2>Title</h2>
            <input type="text" name="post[title]" placeholder="タイトル" />
        </div>
        <div class="body">
            <h2>Body</h2>
            <textarea name="post[body]" placeholder="ここに内容を入力"></textarea>
        </div>
        <input type="submit" value="保存" />
    </form>
    <div class="footer">
        <a href="/">一覧へ戻る</a>
    </div>
</body>

</html>
</form>
</body>

</html>