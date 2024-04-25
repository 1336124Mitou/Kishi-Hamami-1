<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>質問一覧</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 20px;
        }

        .question {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .question h2 {
            color: #4267b2;
        }

        .question a {
            color: #4267b2;
            text-decoration: none;
        }

        footer {
            background-color: #f4f4f4;
            padding: 10px 20px;
            text-align: center;
        }

        p.tag {
            border: 1px solid;
            display: inline-block;
            border-radius: 20px;
            background-color: #ccc;
        }
    </style>
    <script>

    </script>
</head>

<body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>
        <nav>
            <ul class="nav">
                <li><a href="index.php" class="btn4">ホーム</a></li>
                <li><a href="Allquestion.php" class="btn2">質問一覧</a></li>
                <li><a href="Allproject.php" class="btn4">制作物一覧</a></li>
                <li><a href="profile.php" class="btn4">プロフィール</a></li>
                <li><a href="login.php" class="btn4">ログイン</a></li>
            </ul>
        </nav>
    </header>
    <a class="que" href="question.php">質問を追加する</a>

    <main>
        <input type="text" id="filterInput" oninput="filterArticles(this.value)" placeholder="絞り込み" style="width: 300px;height: 40px;">
        <section class="question">
            <form method="post" action="answer.php">
                <h2><a href="Qdet1.php">C言語についての質問</a></h2>
                <p><a href="Qdet1.php">質問内容:C言語のポインタがさっぱり分かりません。...</a></p>
                <p class="tag">#プログラミング言語</p><br>
            </form>
        </section>
    </main>
    <main>
        <section class="question">
            <form method="post" action="answer.php">
                <h2><a href="Qdet2.php">データベースについての質問</a></h2>
                <p><a href="Qdet2.php">質問内容:データベースを作りたいのですが...</a></p>
                <p class="tag">#データベース</p><br>
            </form>
        </section>
    </main>
    <main>
        <section class="question">
            <form method="post" action="answer.php">
                <h2><a href="Qdet3.php">AIついての質問</a></h2>
                <p><a href="Qdet3.php">質問内容:AIの活用方法を探しています。このような性能を...</a></p>
                <p class="tag">#AI</p><br>
            </form>
        </section>
        <!-- 他の質問も同様に追加 -->
    </main>
    <script>
        function filterArticles(keyword) {
            var articles = document.querySelectorAll('.article');
            articles.forEach(function(article) {
                var tags = article.getAttribute('data-tags');
                var title = article.querySelector('h2').innerText.toLowerCase();
                if (tags.includes(keyword) || title.includes(keyword.toLowerCase())) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        }

        function filterArticles(keyword) {
            var articles = document.querySelectorAll('.question');
            articles.forEach(function(article) {
                var title = article.querySelector('h2').innerText.toLowerCase();
                var tag = article.querySelector('.tag').innerText.toLowerCase();
                if (title.includes(keyword.toLowerCase()) || tag.includes(keyword.toLowerCase())) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>