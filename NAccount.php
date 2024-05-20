<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale-1.0">
        <title>NAccount</title>
        <style>

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
        <!-- ホーム画面に戻るテキストと新規アカウント登録のページであることをユーザーに示すテキスト -->
        <header>
            <a href="index.php">ホーム画面に戻る</a>
            <h1>新規登録</h1>
        </header>

        <form method="POST" action="NUser.php">
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
            <input type="file" name="imageFile" accept="image/*" required><br>

            <label for="textbox">自由記入欄：</label>
            <input type="text" id="info" name="info" required><br><br>

            <input class="button" type="submit" value="新規登録">

        </form>
    </body>
</html>