<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事詳細</title>
    <link rel="stylesheet" href="main.css">
    <style>
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

        #form2 {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            z-index: 1000;
        }

        #form2 form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

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

        .user {
            display: inline-block;
            position: relative;
            border-radius: 50%;
            background-color: #89baeb;
            width: 1em;
            height: 1em;
            font-size: 50px;
            overflow: hidden;
        }

        .user::before,
        .user::after {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 50%;
            background-color: #3388dd;
            content: "";
        }

        .user::before {
            top: 0.15em;
            width: 0.4em;
            height: 0.4em;
        }

        .user::after {
            bottom: -0.4em;
            width: 0.8em;
            height: 0.8em;
        }

        #comment-list {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }

        .comment {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: flex;
            align-items: center;
        }

        .comment .user-icon {
            background-color: #89baed;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment .user-icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment .comment-text {
            flex-grow: 1;
        }

        .comment .comment-text p {
            margin: 0;
        }

        .comment .username {
            font-weight: bold;
            margin-right: 10px;
        }

        .comment .timestamp {
            font-size: 0.8em;
            color: #666;
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

    <form id="form2">
        <label for="comment">コメント：</label>
        <input type="text" id="comment" name="comment">

        <input type="submit" value="送信">
    </form>

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

        const comments = [{
                username: "ユーザーA",
                comment: "これはテストコメントです",
                timestamp: "2024-04-24 12:34"
            },
            {
                username: "ユーザーB",
                comment: "素晴らしい記事ですね！",
                timestamp: "2024-04-24 12:35"
            }
        ];

        //コメント表示の為の関数
        function displayComments() {
            const commentList = document.getElementById("comment-list");

            //コメントリストのクリア
            commentList.innerHTML = "";

            //各コメントの表示
            comments.forEach(comment => {
                const commentDiv = document.createElement("div");
            })
        }
    </script>

    <h2>コメント一覧</h2>
    <form id="form3">
        <span class="user"></span>
    </form>
    <div id="comment-list">
        <!-- ここにコメントが追加されます -->
    </div>

    <div class="home-link-container">
        <a href="index.php">ホーム</a>
    </div>
</body>

</html>