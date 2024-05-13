<?php
if (!isset($quest)) { // $questionに必ずquestionオブジェクトをセットするため
    require_once __DIR__ . '/shitsumon.php';
    require_once __DIR__ . '/tags.php';
    $quest = new Quest();
    $tags = new Tag();
}
if (isset($_POST["Filter"]) && $_POST["Filter"] != 0) {
    $Filter = $_POST["Filter"];
}

if (!isset($Filter)) {
    $showQuestions = $quest->showAllQuestions();
} else {
    $showQuestions = $tags->sortTagQ($Filter);
}
$showTags = $tags->showTags();
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
            resize: none;
            text-align: center;
        }

        input.submit {
            display: inline-block;
            color: #fff;
            background: #007BFF;
            border-radius: 20px;
            padding: 0.5em 1.5em;
            border-color: #007BFF;
        }

        input.submit:hover {
            opacity: 0.7;
        }

        .filter {
            display: inline-flex;
            align-items: center;
            position: relative;
        }

        .filter::after {
            position: absolute;
            right: 15px;
            width: 10px;
            height: 7px;
            background-color: #535353;
            clip-path: polygon(0 0, 100% 0, 50% 100%);
            content: '';
            pointer-events: none;
        }

        .filter select {
            appearance: none;
            min-width: 230px;
            height: 2.8em;
            padding: .4em calc(.8em + 30px) .4em .8em;
            border: 1px solid #d0d0d0;
            border-radius: 3px;
            background-color: #fff;
            color: #333333;
            font-size: 1em;
            cursor: pointer;
        }
    </style>

    <script>
        function check(id) {
            document.getElementById(id).checked = true;
        }
    </script>
</head>

<body>
    <?php
    //ヘッダーを読み込む
    require_once __DIR__ . '/header.php';
    ?>
    <!-- クリック動作判定 -->
    <input class="checkbox" type="checkbox" id="popup">

    <!-- ポップアップ部分 -->
    <div id="overlay">
        <label for="popup" id="bg_gray"></label> <!-- ウィンドウの外のグレーの領域 -->

        <div id="window"> <!-- ウィンドウ部分 -->
            <label for="popup" id="btn_cloth"> <!-- 閉じるボタン -->
                <span></span>
            </label>
            <div id="msg"> <!-- ウィンドウのコンテンツ -->
                <form method="POST" action="shitsumonadd.php">
                    <h2>質問投稿</h2>
                    <div class="textarea">
                        <textarea id="question" name="QDet" rows="5" cols="70" required></textarea><br><br>
                        <!-- ユーザーIDを送る -->
                        <input type="hidden" name="userid" value="999">
                        <!-- タグIDをおくる -->
                        <select name="Qtag">
                            <?php
                            foreach ($showTags as $showTag) {
                            ?>
                                <option value="<?= $showTag['TagID'] ?>"><?= $showTag['TagName'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="que">
                            <!-- 投稿ボタン -->
                            <input class="submit" type="submit" value="投稿">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="que">
        <input class="button" onclick="check('popup');" type="button" value="質問を追加する">
    </div>
    <!-- ここまでポップアップ -->
    <!-- 絞り込み機能 -->
    <label class="filter">
        絞り込み
        <form method="post" action="">
            <select name="Filter" onchange="submit(this.form)">
                <option value="0" <?php if (empty($Filter)) echo 'selected'; //$Filterが空ならselectedを表示する 
                                    ?>>All</option>
                <?php
                foreach ($showTags as $showTag) {
                    if ($Filter == $showTag['TagID']) { //$Filterと$showTagが同じならselectedを表示する
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                ?>
                    <option value="<?= $showTag['TagID']  ?>" <?= $selected ?>><?= $showTag['TagName'] ?></option>
                <?php
                }
                ?>
            </select>
        </form>
    </label>
    <?php
    if (empty($showQuestions)) { //質問が無いなら
        echo '<h4>質問はありません';
        echo '</body>';
    } else { //質問があるなら
    ?>
        <?php
        //文字数の上限
        $limit = 20;
        foreach ($showQuestions as $showQuest) {
            //質問が20文字以上ならそこで区切って...を表示する
            if (mb_strlen($showQuest['Question']) > $limit) {
                $q = mb_substr($showQuest['Question'], 0, $limit) . '...';
            } else {
                $q = $showQuest['Question'];
            }
            $qtag = $tags->showTagQ($showQuest['QuestionID']);
        ?>
            <main>
                <section class="question">
                    <form method="post" name="answer" action="answer.php">
                        <input type="hidden" name="question_id" value="<?= $showQuest['QuestionID'] ?>">
                        <h2 class="questionndata"><?= $q ?></h2>
                        <p class="tag"># <?= $qtag['TagName'] ?></p><br>
                        <input type="submit" value="詳細">
                    </form>
                </section>
            </main>
        <?php
        }
        ?>
    <?php
    }
    ?>


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