<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale-1.0">
        <title>ログイン</title>
        <style>

        </style>
    </head>
    <body>
        <header>
            <a href="index.php">ホーム画面に戻る</a>
            <h1>ログイン</h1>
        </header>
        <!-- 名前を入力するためのテキストボックス -->
        <label for="textbox">名前:</label>
        <input type="text" id="name" name="name"><br>

        <!-- メールを入力するためのテキストボックス -->
        <label for="textbox">メール:</label>
        <input type="email" id="mail" name="email"><br>

        <!-- パスワードを入力するためのテキストボックス -->
        <label for="textbox">パスワード：</label>
        <input type="password" id="pass" name="password"><br>
    <br>
        <a href="NAccount.php">新規登録する</a>
    </body>
</html>