<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事詳細</title>
    <link rel="stylesheet" href="main.css">
    <style>
        /* 記事 */
        #form1 {
            width: 500px;
            height: 600px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h1,
        h2 {
            text-align: center;
        }

        /*コメント入力ポップアップ*/
        .comment-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .comment-popup h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .comment-input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        /* その他のスタイリング */
        body:not(.overlay) {
            transition: 0.5s;
        }

        body.overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .home-link-container {
            text-align: center;
            margin-top: 20px;
        }

        .home-link-container a {
            text-decoration: none;
            color: #333;
            background-color: #ccc;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>
        <nav>
            <ul class="nav">
                <li><a href="index.php" class="btn4">ホーム</a></li>
                <li><a href="Allquestion.php" class="btn4">質問一覧</a></li>
                <li><a href="Allproject.php" class="btn2">制作物一覧</a></li>
                <li><a href="profile.php" class="btn4">プロフィール</a></li>
                <li><a href="login.php" class="btn4">ログイン</a></li>
            </ul>
        </nav>
    </header>
    <h1>テンプレート</h1>
    <form id="form1"></form>
    <button onclick="toggleForm()">コメント入力</button>

    <div id="form2" class="comment-popup">
        <span class="close-btn" onclick="toggleForm()">&times;</span>
        <h2>コメントを入力する</h2>
        <form>
            <div class="form-group">
                <label for="comment">コメント：</label>
                <input type="text" id="comment" name="comment" class="comment-input">
            </div>
            <input type="submit" value="送信" class="submit-btn">
        </form>
    </div>

    <script>
        function toggleForm() {
            var form = document.getElementById("form2");
            var body = document.body;

            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
                body.classList.add("overlay");
            } else {
                form.style.display = "none";
                body.classList.remove("overlay");
            }
        }
    </script>

    <h2>コメント一覧</h2>
    <form id="form3"></form>
    <div class="home-link-container">
        <a href="index.php">ホーム</a>
    </div>
</body>

</html>