<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>プログラミング情報共有サイト（仮）</title>
    <link href="main.css" rel="stylesheet">
    <style>
        /* Add styles for the active link */
        .active-link {
            border-bottom: 2px solid #3367ff;
        }
    </style>
</head>

<body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>
        <nav>
            <ul class="nav">
                <!--ヘッダー ここから-->
                <li><a id="indexLink" href="index.php" class="btn2">ホーム</a></li>
                <li><a id="AllquestionLink" href="Allquestion.php" class="btn4">質問一覧</a></li>
                <li><a id="AllprojectLink" href="Allproject.php" class="btn4">制作物一覧</a></li>
                <li><a id="profileLink" href="profile.php" class="btn4">プロフィール</a></li>
                <li><a id="loginLink" href="login.php" class="btn4">ログイン</a></li>
                <!--ヘッダー 追加はここから-->
            </ul>
        </nav>
    </header>

    <script>
        // 現ページのURLを取得します
        var currentPageURL = window.location.href;

        console.log("Current Page URL:", currentPageURL);

        // クラスとページ名に応じての配列
        var pageClasses = {
            "index.php": "btn2",
            "Allquestion.php": "btn4",
            "Allproject.php": "btn4",
            "profile.php": "btn4",
            "login.php": "btn4"
        };

        // マッチを見つかるまでにpageClassesにループをさせる
        for (var page in pageClasses) {
            if (currentPageURL.includes(page)) {
                console.log("Match found for:", page);

                // すべてのクラスからactive-linkを削除する
                document.querySelectorAll(".nav a").forEach(function(link) {
                    link.classList.remove("active-link");
                });
                
                // もしマッチがあった場合、そのクラスを更新し、index.phpのクラスも更新します
                var linkId = page.split('.')[0] + "Link";
                document.getElementById(linkId).classList.remove("btn4");
                document.getElementById(linkId).classList.add(pageClasses[page]);
                document.getElementById("indexLink").classList.remove("btn2");
                document.getElementById("indexLink").classList.add("btn4");
                // マッチしたページにactive-linkクラスを追加する
                document.getElementById(linkId).classList.add("active-link");
            }
        }
    </script>
</body>

</html>
