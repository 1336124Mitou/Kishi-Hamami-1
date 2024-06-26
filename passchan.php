<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require_once __DIR__ . '/header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード変更</title>
    <link href="main.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .password-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            padding: 20px;
            margin: 50px auto;
            position: relative;
        }

        .password-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .password-form {
            display: flex;
            flex-direction: column;
        }

        .password-form label {
            font-size: 14px;
            color: #777;
            text-align: left;
            margin-bottom: 5px;
        }

        .password-form input {
            font-size: 16px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .password-form button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .password-form button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #007bff;
            color: white;
            margin: 5% auto;
            padding: 5px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 10px;
            text-align: center;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <!-- 変更成功メッセージ内容の記述 -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close"></span>
            <p>パスワードの変更に成功しました</p>
        </div>
    </div>

    <div class="password-container">
        <?php
        if (isset($error)) { //エラーメッセージがあれば表示する
            echo '<p class="error">' . $error . '</p>';
        }
        if (isset($mess)) { //エラーメッセージ以外のメッセージがあれば表示する
            echo '<p class="mess">' . $mess . '</p>';
        }
        ?>
        <div class="password-header">パスワード変更</div>
        <form class="password-form" method="post" action="passchandb.php">
            <label for="current-password">現在のパスワード</label>
            <input type="password" id="current-password" name="current_password" required>
            <label for="new-password">新しいパスワード</label>
            <input type="password" id="new-password" name="new_password" required>
            <label for="confirm-password">新しいパスワード (確認)</label>
            <input type="password" id="confirm-password" name="confirm_password" required>
            <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
            <button type="submit">変更する</button>
        </form>
    </div>

    <script>
        // 変更成功メッセージ制御
        function showModal() {
            var modal = document.getElementById("successModal");
            var span = document.getElementsByClassName("close")[0];

            modal.style.display = "block";

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        <?php if (isset($mess)) { ?>
            // ポップアップの表示
            showModal();
        <?php } ?>
    </script>
</body>

</html>