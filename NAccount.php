<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale-1.0">
        <title>NAccount</title>
        <style>
            body {
                background-color: #f4f4f4;
            }

            #newu {
                display: flex;
                flex-direction: column;
            }

            #entry {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 400px;
                text-align: center;
                padding: 20px;
                margin: 50px auto;
                position: relative;
            }

            #entry label {
                font-size: 14px;
                color: #777;
                text-align: left;
                margin-bottom: 5px;
            }

            #newu-button {
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 50px;
                padding: 10px;
                font-size: 16px;
                cursor: pointer;
            }

            #newu-button:hover {
                background-color: #0056b3;
            }

            #login-box {
                border-radius: 10px;
                width: 400px;
                text-align: center;
                padding: 20px;
                margin: 50px auto;
                position: relative;
            }

            #login-button {
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
            }

            #login-button:hover {
                background-color: #0056b3;
            }

            #login-sentence {
                display: flex;
                align-items: center;
                margin: 20px 0;
            }

            #login-sentence::before,
            #login-sentence::after {
                content: "";
                height: 1px;
                flex-grow: 1;
                background-color: #666;
            }

            #login-sentence::before {
                margin-right: 10px;
            }

            #login-sentence::after {
                margin-left: 10px;
            }
        </style>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            
            if (message === 'email_exists') {
                alert('このメールは既に登録されています。');
            } else if (message === 'wrong_password') {
                alert('パスワードの入力が間違っています。');
            }
        });
    </script>
    </head>
    <body>
        <div id="entry">
            <!-- ホーム画面に戻るテキストと新規アカウント登録のページであることをユーザーに示すテキスト -->
            <header>
                <h1>新規登録</h1>
            </header>

            <form method="POST" id="newu" action="NUser.php">
                <!-- 名前を入力するためのテキストボックス -->
                <label for="textbox">名前:</label>
                <input type="text" id="name" name="name" required><br>

                <!-- メールを入力するためのテキストボックス -->
                <label for="textbox">メール:</label>
                <input type="email" id="mail" name="email" required><br>

                <!-- パスワードを入力するためのテキストボックス -->
                <label for="textbox">パスワード：</label>
                <input type="password" id="pass" name="password" required><br>

                <!-- パスワードの確認するためのテキストボックス-->
                <label for="textbox">再度パスワードの入力：</label>
                <input type="password" id="checkpass" name="check" required><br>

                <label>プロフィールのアイコンを追加する：</label><br>
                <input type="file" id="pasta" name="imageFile" accept="image/*" required><br>

                <label for="textbox">自由記入欄：</label>
                <input type="text" id="info" name="info" required><br><br>

                <input class="button" type="submit" id="newu-button" value="新規登録">
            </form>
        </div>
        <br>
        <div id="login-box">
            <p id="login-sentence">既にアカウントを持ちの方はこちらへ</p>
            <a id="login-button" href="login.php">ログイン画面へ</a>
        </div>
    </body>
</html>