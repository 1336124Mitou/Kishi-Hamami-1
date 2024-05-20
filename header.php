<!DOCTYPE html>
<html lang="ja">
<?php
session_start();
//セッションにデータが無ければログイン画面に遷移する
if (empty($_SESSION['userId'])) {
    header('Location: login.php');
}

?>

<head>
    <meta charset="UTF-8">
    <title>プログラミング情報共有サイト（仮）</title>
    <link href="main.css" rel="stylesheet">
    <style>
        /* Add styles for the active link */
        .active-link {
            border-bottom: 2px solid #3367ff;
        }

        /* ポップアップメニューのスタイル */
        .popup-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        /* ポップアップメニューのリンクのスタイル */
        .popup-menu a {
            color: black;
            padding: 8px 0;
            display: block;
        }

        /* ポップアップメニューが表示されるときのスタイル */
        .show {
            display: block;
        }

        /* プロフィールアイコンのスタイル */
        .profile-icon {
            cursor: pointer;
            width: 40px;
            /* 適切な幅に調整 */
            height: 40px;
            /* 適切な高さに調整 */
            border-radius: 50%;
            /* 円形にするための角丸 */
            margin-right: 10px;
            /* アイコンと他の要素の間隔を調整 */
            float: right;
            /* アイコンを右側に配置 */
        }

        /* 追加：ポップアップメニューの位置調整 */
        .popup-menu {
            top: 60px;
            /* アイコンの下に表示 */
            right: 0;
            /* アイコンの右端に揃える */
        }
    </style>
</head>

<body>
    <header>
        <div class="header-content">
            <img src="1676155437876-5NNUYKTjTE.png" alt="Profile Icon" class="profile-icon" onclick="togglePopup()">
            <!-- ポップアップメニュー -->
            <div id="popupMenu" class="popup-menu">
                <a href="profile.php">マイプロフィール</a>
                <a href="update_profile.php">プロフィール編集</a>
                <a href="logout.php" class="logout">ログアウト</a>
            </div>
            <h1>プログラミング情報共有サイト（仮）</h1>
            <nav>
                <ul class="nav">
                    <!--ヘッダー ここから-->
                    <li><a id="indexLink" href="index.php" class="btn4">ホーム</a></li>
                    <li><a id="AllquestionLink" href="Allquestion.php" class="btn4">質問一覧</a></li>
                    <li><a id="AllprojectLink" href="Allproject.php" class="btn4">制作物一覧</a></li>
                    <!--ヘッダー 追加はここから-->
                </ul>
            </nav>
        </div>
    </header>

    <script>
        // 現ページのURLを取得します
        var currentPageURL = window.location.href;

        console.log("Current Page URL:", currentPageURL);

        // クラスとページ名に応じての配列
        var pageClasses = {
            "index.php": "btn4",
            "Allquestion.php": "btn4",
            "Allproject.php": "btn4",
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
                // マッチしたページにactive-linkクラスを追加する
                document.getElementById(linkId).classList.add("active-link");
            }
        }
        // ポップアップメニューの表示切り替え
        function togglePopup() {
            var popupMenu = document.getElementById("popupMenu");
            popupMenu.classList.toggle("show");
        }

        // プロフィールアイコン以外をクリックした場合にポップアップメニューを非表示にする
        window.onclick = function(event) {
            var popupMenu = document.getElementById("popupMenu");
            if (!event.target.matches('.profile-icon')) {
                if (popupMenu.classList.contains('show')) {
                    popupMenu.classList.remove('show');
                }
            }
        }
    </script>
</body>

</html>