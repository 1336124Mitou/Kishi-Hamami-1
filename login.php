<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <title>ログイン</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            padding: 20px;
            margin: 50px auto;
            position: relative;
        }

        .login-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            font-size: 14px;
            color: #777;
            text-align: left;
            margin-bottom: 5px;
        }

        .login-form input {
            font-size: 16px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .login-form button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .newaccount-box {

            border-radius: 10px;
            width: 400px;
            text-align: center;
            padding: 20px;
            margin: 50px auto;
            position: relative;
        }

        .newaccount-button {
            display: inline-block;
            width: 380px;
            border-radius: 5px;
            font-size: 12pt;
            text-align: center;
            cursor: pointer;
            padding: 10px;
            background: #007bff;
            color: #ffffff;
            text-decoration-line: none;
            /* line-height: 1em;
            transition: .3s;
            border: 2px solid #000066; */
        }

        .newaccount-sentence {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .newaccount-sentence::before,
        .newaccount-sentence::after {
            content: "";
            height: 1px;
            flex-grow: 1;
            background-color: #666;
        }

        .newaccount-sentence::before {
            margin-right: 10px;
        }

        .newaccount-sentence::after {
            margin-left: 10px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <?php
        session_start();
        unset($_SESSION['userId']);
        unset($_SESSION['userName']);
        if (isset($_SESSION['login_error'])) { // ログイン時エラーメッセージがあれば
            echo '<p class="error">' . 'ログインできませんでした。' . '<br>' . $_SESSION['login_error'] . '</p>'; // そのエラーメッセージを表示し、
            unset($_SESSION['login_error']); // セッション情報から削除する
        } else {
            echo '<p>利用するにあたってはログインしてください。</p>';
        }
        ?>
        <h1>ログイン</h1>
        <form method="post" class="login-form" action="logindb.php">
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
    <div class="newaccount-box">
        <p class="newaccount-sentence">新規登録はこちらから</p><br>
        <a class="newaccount-button" href="NAccount.php">新規登録する</a>
    </div>
    <?php
    //echo $_SESSION['userName'];
    ?>
</body>

</html>