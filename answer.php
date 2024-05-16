<?php
if (!isset($quest)) { // $questionに必ずquestionオブジェクトをセットするため
    require_once __DIR__ . '/shitsumon.php';

    $quest = new Quest();
}
if (!isset($kaitou)) {
    require_once __DIR__ . '/kaitou.php';
    $kaitou = new Comment();
}
if (!isset($tags)) { //$tagsに必ずTagオブジェクトをセットするため
    require_once __DIR__ . '/tags.php';
    $tags = new Tag();
}


//POSTが定義されているなら取得する
if (isset($_POST["question_id"])) {
    $question_id = $_POST["question_id"]; // 質問のIDを取得する
}
//与えられたIDから質問を取得
$showQuestion = $quest->showQuestion($question_id);

//与えられた質問IDから回答を取得
$showAnswers = $kaitou->showAllAnswer($question_id);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <?php
    require_once __DIR__ . '/header.php';
    ?>
    <meta charset="UTF-8">
    <title>質問詳細</title>

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

        footer {
            background-color: #f4f4f4;
            padding: 10px 20px;
            text-align: center;
        }

        /* ボタンの微調整 */
        input.button {
            border: 1px solid;
            width: 100px;
            height: 35px;
            font-size: 15px;
            align-self: center;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #007BFF;
        }

        p.tag {
            border: 1px solid;
            display: inline-block;
            border-radius: 20px;
            background-color: #ccc;
        }

        .frame {
            padding: 10px;
            width: 450px;
            margin-bottom: 10px;
            border: 1px solid #333333;
            border-radius: 10px;
            word-break: break-all;
        }

        .checkbox {
            display: none;
        }

        /* ポップアップwindow部分 */
        #overlay {
            visibility: hidden;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 70;
            width: 100%;
            height: 100%;
        }

        /* オーバーレイの背景部分 */
        #bg_gray {
            background: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 80;
        }

        /* ウィンドウ部分 */
        #window {
            width: 50%;
            padding: 20px;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px -6px rgba(0, 0, 0, 0.6);
            z-index: 90;
            opacity: 0;
        }

        /* 閉じるボタン */
        #btn_cloth {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #007BFF;
            border-radius: 5px;
            z-index: 100;
            cursor: pointer;
        }

        #btn_cloth:hover {
            opacity: 0.7;
        }

        #btn_cloth span,
        #btn_cloth span::before {
            display: block;
            height: 3px;
            width: 25px;
            border-radius: 3px;
            background: #fff;
        }

        #btn_cloth span {
            transform: rotate(45deg);
        }

        #btn_cloth span::before {
            content: "";
            position: absolute;
            bottom: 0;
            transform: rotate(-90deg);
        }


        /* クリックでオーバーレイ表示 */
        #popup:checked~#overlay {
            visibility: visible;
        }

        #popup:checked~#overlay #window {
            animation: fadein 500ms forwards;
            animation-timing-function: ease-in-out;
        }

        @keyframes fadein {
            100% {
                opacity: 1;
            }
        }

        /* オーバーレイのスタイル */
        #msg a {

            display: inline-block;
            color: #fff;
            background: #007BFF;
            border-radius: 20px;
            padding: 0.5em 1.5em;
        }

        #msg a:hover {
            opacity: 0.7;
        }

        #msg h2,
        .textarea {
            text-align: center;
        }

        .post {
            text-align: right;
        }

        .timestamp {
            text-align: right;
            color: #9c9998;
            float: right;
        }

        .comment {
            word-wrap: break-word;
        }

        .timestamptwo {
            margin-left: 200px;
            color: #9c9998;
        }

        .likenum,
        .likes,
        .timestamptwo {
            display: inline-block;
            align-items: center;

        }

        .answer-info {
            display: flex;
            align-items: center;
        }

        .date-and-like {
            display: flex;
            /* 中央揃え */
            align-items: center;
            /* 要素内を1行で表示 */
            white-space: nowrap;
        }

        .likes {
            margin-left: 10px;
            /* いいねボタンと日付の間のスペースを調整するための余白 */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const num1 = document.getElementById('num1');
            const button1 = document.getElementById('bt1');
            const num2 = document.getElementById('num2');
            const button2 = document.getElementById('bt2');

            let count1 = 0;
            let count2 = 0;

            button1.addEventListener('click', function() {
                count1++;
                num1.innerHTML = count1;
            });

            button2.addEventListener('click', function() {
                count2++;
                num2.innerHTML = count2;
            });
        });

        function check(id) {
            document.getElementById(id).checked = true;
        }
    </script>
</head>



<main>
    <?php
    $tag = $tags->showTagQ($question_id);
    ?>
    <div class="frame">
        <h2>質問</h2>
        <hr>

        <p><?= $showQuestion['Question'] ?></p>

        <p class="tag"># <?= $tag['TagName'] ?></p><br>

        <p class="timestamp"><?= $showQuestion['D'] ?></p>
        <input class="button" onclick="check('popup');" type="button" value="回答追加">
    </div>
</main>

<main>
    <div class="frame">
        <h2>回答</h2>
        <!-- 回答部分 -->
        <?php foreach ($showAnswers as $showAnswer) { ?>
            <div class="answer-info">
                <div class="interaction">
                    <!-- コメント -->
                    <p class="comment" style="word-wrap: break-word;"><?= $showAnswer['Reply'] ?></p><br>
                    <!-- 日付といいねボタン -->
                    <div class="date-and-like">
                        <!-- いいねボタン -->
                        <div>
                            <p class="likenum" id="likesDisplay<?= $showAnswer['RepID'] ?>"><?= $showAnswer['LNum'] ?></p>
                            <button class="likes" onclick="likeAnswer(<?= $showAnswer['RepID'] ?>)">いいね！</button>
                        </div>
                        <!-- 日付 -->
                        <p class="timestamptwo"><?= $showAnswer['D'] ?> <?= $showAnswer['Tim'] ?></p>
                    </div>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>
</main>



<script>
    function check(id) {
        document.getElementById(id).checked = true;
    }

    function likeAnswer(answerId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "like.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                updateLikesDisplay(answerId, response);
            }
        };
        xhr.send("answer_id=" + answerId);
    }

    function updateLikesDisplay(answerId, likesCount) {
        document.getElementById('likesDisplay' + answerId).innerHTML = likesCount;
    }
</script>



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
            <form method="POST" action="kaitouadd.php">
                <!-- ユーザーのIDを取得する -->
                <input type="hidden" name="userID" value="kd1@gmail.com">
                <h2>回答投稿</h2>
                <div class="textarea">
                    <textarea id="answer" name="Com" rows="5" cols="70" required></textarea>
                    <input type="hidden" name="QuestionID" value="<?= $question_id ?>">
                    <div class="post">
                        <input type="submit" value="投稿">
                    </div>
            </form>
        </div>
    </div>
</div>



</div>
<?php
require_once  __DIR__ . '/footer.php';  // footer.phpを読み込む	
?>
</body>

</html>