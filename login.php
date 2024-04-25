<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale-1.0">
        <title>ログイン</title>
        <link href="main.css" rel="stylesheet">
        <style>

        </style>
    </head>
    <body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>

        <nav>
            <ul class="nav">
                <!--ヘッダー ここから-->
                <li><a href="index.php" class="btn4">ホーム</a></li>
                <li><a href="Allquestion.php" class="btn4">質問一覧</a></li>
                <li><a href="Allproject.php" class="btn4">制作物一覧</a></li>
                <li><a href="profile.php" class="btn4">プロフィール</a></li>
                <li><a href="login.php" class="btn2">ログイン</a></li>
                <!--ヘッダー 追加はここから-->
            </ul>
        </nav>

    </header>
        <h1>ログイン</h1>
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
        <a href="index.php">ホームに戻る</a>
    </body>
</html>