<?php
    if(!isset($kiji)) {
        require_once __DIR__.'/kiji.php';
        $kiji = new Report();
    }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" contant="width=device-width, initial-scale=1.0">
    <title>記事投稿</title>
    <style>
        .okuru {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="okuru">
        <!-- ページのタイトル -->
        <h1>記事投稿</h1>

        <form method="POST" action="kijiadd.php">
            <!-- 記事タイトル入力 -->
            <h4>記事のタイトル</h4>
            <textarea id="Title" name="Title" placeholder="ここに記事のタイトルを書いてください" required></textarea>

            <!-- 記事入力 -->
            <h4>記事内容</h4>
            <textarea id=" report" name="RDet" placeholder="ここに記事を入力してください。" oninput="changeTextColor(this)" required></textarea><br>

            <input type="submit" value="投稿">
        </form>
    </div>
</body>

</html>