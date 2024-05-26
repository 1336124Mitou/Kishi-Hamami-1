<?php
if (!isset($quest)) { // $questionに必ずquestionオブジェクトをセットするため
    require_once __DIR__ . '/shitsumon.php';
    $quest = new Quest();
}

if (!isset($tags)) { // $tagに必ずtagオブジェクトをセットするため
    require_once __DIR__ . '/tags.php';
    $tags = new Tag();
}

if (!isset($uq)) {
    require_once __DIR__ . '/user.php';
    $uq = new UQ();
    $us = new User();
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
    <?php
    //ヘッダーを読み込む
    require_once __DIR__ . '/header.php';
    ?>
</head>
<style>
    /* main {
        padding: 20px;
    } */

    .title {
        font-weight: bold;
        line-height: 2;
        color: #000000;
        margin: 10px;
    }

    .main {
        /* 幅を指定 */
        width: 80%;
        /* 最大幅を指定 */
        max-width: 1200px;
        /* 自動的に中央に配置 */
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
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
        font-weight: bold;
        border: 1px solid;
        display: inline-block;
        border-radius: 20px;
        background-color: #e9ecef;
        color: #333;
        padding: 5px 10px;
        border-radius: 15px;
        margin: 10px 0;

    }

    /* ボタンの微調整 */
    .button {
        background-color: #fff;
        border-color: #fff;
        margin-left: 5px;
    }

    input.button {
        border: 1px solid;
        width: 150px;
        height: 42px;
        font-size: 15px;
        align-self: center;
        border-radius: 5px;
        cursor: pointer;
        color: white;
        background-color: #007BFF;
    }

    input.button:hover {
        background-color: #0056b3;
    }

    .que {
        text-align: right;
        float: right;
        margin: 10px;
    }

    .textarea {
        resize: none;
        text-align: center;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        /* パディングとボーダーを含めて幅を計算する */
    }

    .textarea textarea {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    input.submit {
        display: inline-block;
        color: #fff;
        background: #007BFF;
        border-radius: 20px;
        padding: 0.5em 1.5em;
        border-color: #007BFF;
        border: none;
        cursor: pointer;
    }

    input.submit:hover {
        opacity: 0.7;
    }

    .filter {
        display: inline-flex;
        align-items: center;
        position: relative;
        margin: 10px;
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
        min-width: 50px;
        height: 2.8em;
        padding: .4em calc(.8em + 30px) .4em .8em;
        border: 1px solid #d0d0d0;
        border-radius: 3px;
        background-color: #fff;
        color: #333333;
        font-size: 1em;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .textarea textarea {
            font-size: 14px;
            /* 小さい画面ではフォントサイズも調整すると良い */
        }
    }

    .UserName {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        margin: 0;
        font: inherit;
        font-weight: bold;
        font-size: 23px;
        color: #4267b2;
    }

    .UserNamebox {
        display: flex;
        align-items: flex-end;
    }

    .extra {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .date {
        margin-left: 200px;
        font-weight: bold;
        color: #666;
    }

    .not-user {
        margin-left: 25px;
    }

    .Qpropic {
        cursor: pointer;
        /* 適切な幅に調整 */
        width: 40px;
        /* 適切な高さに調整 */
        height: 40px;
        /* 円形にするための角丸 */
        border-radius: 50%;
        /* アイコンと他の要素の間隔を調整 */
        margin-right: 10px;
        /* アイコンを左側に配置 */
        float: left;
    }

    .Qpropic:hover {
        filter: brightness(0.95);
    }

    .Qprofpicbutton {
        border: none;
        background: transparent;
    }

    .Qprof {
        /* フレックスコンテナであることを指定 */
        display: flex;
        /* 交差軸：上下の配置 下ぞろえ*/
        align-items: flex-end;
        margin-top: 10px;
    }
</style>


<script>
    function check(id) {
        document.getElementById(id).checked = true;
    }
</script>


<body>

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
                        <input type="hidden" name="userid" value="<?= $_SESSION['userId'] ?>">

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
    <!-- ここまでポップアップ -->

    <div class="main">
        <h2 class="title">質問一覧</h2>
        <!-- 質問追加ボタン -->
        <div class="que">
            <input class="button" onclick="check('popup');" type="button" value="質問を追加する">
        </div>
        <!-- 絞り込み機能 -->
        <label class="filter">
            <form method="post" action="">
                <select name="Filter" onchange="submit(this.form)">
                    <option disabled selected>絞り込む</option>
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

        <hr>

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
                    $q = htmlspecialchars(mb_substr($showQuest['Question'], 0, $limit) . '...', ENT_QUOTES);
                } else {
                    $q = htmlspecialchars($showQuest['Question'], ENT_QUOTES);
                }
                $qtag = $tags->showTagQ($showQuest['QuestionID']);

                $Uname = $uq->detailUQlink($showQuest['QuestionID']);
                $urpro = $us->tokuteiUser($Uname['UsID']);
                if (empty($urpro['ProfPic'])) { //画像が登録されてなかったらデフォルトの画像を表示するようにする。
                    $Qprofpic = "noimage.png";
                } else {
                    $Qprofpic = $urpro['ProfPic'];
                }
            ?>
                <main>
                    <section class="question">
                        <!-- <form method="post" name="answer" action="answer.php"> -->
                        <!-- <input type="hidden" name="question_id" value="<?= $showQuest['QuestionID'] ?>"> -->
                        <form method="POST" action="profile.php">
                            <input type="hidden" name="usid" value="<?= $urpro['UsID'] ?>">
                            <div class="Qprof">
                                <button type="submit" class="Qprofpicbutton"><img src="images/<?= $Qprofpic ?>" class="Qpropic"></button>
                                <p class="UserName"><?= $urpro['UsName'] ?></p>
                            </div>
                        </form>
                        <div class="not-user">
                            <h2 class="questionndata"><?= $q ?></h2>
                            <p class="tag"># <?= $qtag['TagName'] ?></p>
                            <form method="post" name="answer" action="answer.php">
                                <input type="hidden" name="question_id" value="<?= $showQuest['QuestionID'] ?>">
                                <div class="extra">
                                    <input class="submit" type="submit" value="詳細">
                                    <p class="date" id="date"><?= $showQuest['D'] ?> <?= substr($showQuest['Tim'], 0, 5) ?></p>
                                </div>
                            </form>
                        </div>
                    </section>
                </main>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </div>


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
    <?php
    require_once  __DIR__ . '/footer.php';  // footer.phpを読み込む	
    ?>
</body>

</html>