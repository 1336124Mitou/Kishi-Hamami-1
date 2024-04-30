<?php
// データベース接続などの設定

// $conn 変数を定義
$servername = "localhost";
$username = "Kishi";
$password = "hamami";
$dbname = "kishi";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

if (!isset($quest)) { // $questionに必ずquestionオブジェクトをセットするため
    require_once __DIR__.'/shitsumon.php';
    $quest = new Quest();
}

$showQuestions = $quest->showAllQuestions();
if (empty($showQuestions)) {
    echo '<h4>質問はありません';
} else {
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>質問一覧</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="popup.css"> <!-- 可読性の関係でオーバーレイ関係だけ分けました -->
    <style>
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

        /* ボタンの微調整 */
        input.button {
            border: 1px solid;
            width: 150px;
            height: 35px;
            font-size: 15px;
            align-self: center;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #007BFF;
        }

        .que {
            text-align: right;
        }

        .textarea {
            text-align: center;
        }
       
    </style>

    <script>
        // filterArticles 関数の修正
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
</head>

<body>
<?php
require_once __DIR__ . '/header.php';
?>

<!-- クリック動作判定 -->
<input class="checkbox" type="checkbox" id="popup">

<!-- ポップアップ部分 -->
<!-- ポップアップ部分 -->
<div id="overlay">
    <label for="popup" id="bg_gray"></label> <!-- ウィンドウの外のグレーの領域 -->

    <div id="window"> <!-- ウィンドウ部分 -->
        <label for="popup" id="btn_cloth"> <!-- 閉じるボタン -->
            <span></span>
        </label>
        <div id="msg"> <!-- ウィンドウのコンテンツ -->
            <form method="POST" action="question.php">
                <h2>質問投稿</h2>
                <div class="textarea">
                    <textarea id="question" name="QDet" rows="5" cols="70"></textarea><br><br>
                    <!-- ユーザーIDを送る -->
                    <input type="hidden" name="userid" value="999">
                    <div class="que">
                        <!-- 投稿ボタン -->
                        <input type="submit" value="投稿">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ポップアップを表示するボタン -->
<div class="que">
    <input class="button" onclick="check('popup');" type="button" value="質問を追加する">
</div>


<main>
    <input type="text" id="filterInput" oninput="filterArticles(this.value)" placeholder="絞り込み" style="width: 300px;height: 40px;">
    <?php foreach ($showQuestions as $showQuest): ?>
        <section class="question">
            <h2><a href="Qdet<?= $showQuest['QuestionID'] ?>.php"><?= $showQuest['Question'] ?></a></h2>
            <p><a>extra info</a></p>
            <p class="tag">#template</p><br>
        </section>
    <?php endforeach; ?>
</main>

<!-- 他の質問も同様に追加 -->

</body>

</html>
<?php
}
?>
