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
    <?php
    session_start();
    if (isset($_SESSION['login_error'])) { // ログイン時エラーメッセージがあれば
        echo '<p class="error_class">' . $_SESSION['login_error'] . '</p>'; // そのエラーメッセージを表示し、
        unset($_SESSION['login_error']); // セッション情報から削除する
    } else {
        echo '<p>利用するにあたってはログインしてください。</p>';
    }
    ?>
    <div class="loginform">
        <h1>ログイン</h1>
        <form method="post" action="logindb.php">
            <!-- メールを入力するためのテキストボックス -->
            <label for="textbox">メールアドレス:</label>
            <input type="email" id="mail" name="email" required><br>

            <!-- パスワードを入力するためのテキストボックス -->
            <label for="textbox">パスワード：</label>
            <input type="password" id="pass" name="password" required><br>
            <input type="submit" value="ログイン">
        </form>
    </div>
    <br>
    <a href="NAccount.php">新規登録する</a>
    <a href="index.php">ホームに戻る</a>
    <?php
    //echo $_SESSION['userName'];
    ?>
</body>

</html>