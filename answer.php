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

if (!isset($user)) {
    require_once __DIR__ . '/user.php';
    $user = new UQ();
}

//POSTが定義されているなら取得する
if (isset($_POST["question_id"])) {
    $question_id = $_POST["question_id"]; // 質問のIDを取得する
}
//与えられたIDから質問を取得
$showQuestion = $quest->showQuestion($question_id);

//与えられた質問IDから回答を取得
$showAnswers = $kaitou->showAllAnswer($question_id);

$userCheck = $user->detailUQlink($question_id);
// ログインユーザーのセッションからユーザーIDを取得するか、テスト目的で直接設定する
$user_id = 'kd1@gmail.com';
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

        #overlay {
            visibility: hidden;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 70;
            width: 100%;
            height: 100%;
        }

        #bg_gray {
            background: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 80;
        }

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
            align-items: center;
            white-space: nowrap;
        }

        .likes {
            margin-left: 10px;
        }

        .textarea {
            resize: none;
            text-align: center;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        .textarea textarea {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* 削除ボタン */
        .delete-button {
            position: absolute;
            top: 240px;
            right: 10px;
        }

        .delete-button form {
            display: inline;
        }

        .delete-button input {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
        }

        .delete-button input:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .textarea textarea {
                font-size: 14px;
            }
        }

        .like-button {
            background-color: transparent;
            /* 背景色を透明にする */
            border: none;
            /* 枠線を消す */
            cursor: pointer;
        }

        .like-button svg {
            width: 24px;
            /* SVG の幅を調整 */
            height: 24px;
            /* SVG の高さを調整 */
            stroke-width: 2px;
            /* ストロークの幅を調整 */
        }

        .like-button .heart-path {
            transition: fill 0.3s;
            /* fill プロパティの変化をアニメーション化する */
        }

        .like-button.liked .heart-path {
            fill: #fc49c7;
            /* いいねが押されたときのハートの色 */
        }
    </style>
</head>

<main>
    <?php
    $tag = $tags->showTagQ($question_id);
    ?>
    <?php
    //ログインしているユーザーと記事を投稿したユーザーが同じなら削除ボタンを表示する
    if ($_SESSION['userId'] == $userCheck['UsID']) {
    ?>
        <!-- 削除ボタン -->
        <div class="delete-button">
            <form method="POST" action="shitsumondelete.php" onsubmit="return confirm('本当に削除しますか？')">
                <input type="hidden" name="QID" value="<?= $question_id ?>">
                <input type="submit" value="削除">
            </form>
        </div>
    <?php
    }
    ?>
    <div class="frame">
        <h2>質問</h2>
        <hr>
        <p><?php echo htmlspecialchars($showQuestion['Question'], ENT_QUOTES); ?></p>
        <p class="tag"># <?= $tag['TagName'] ?></p><br>
        <p class="timestamp"><?= $showQuestion['D'] ?></p>
        <input class="button" onclick="check('popup');" type="button" value="回答追加">
    </div>


    <div class="frame">
        <h2>回答</h2>
        <?php foreach ($showAnswers as $showAnswer) {
        ?>
            <p><?php echo htmlspecialchars($showAnswer['Reply'], ENT_QUOTES); ?></p>
            <?php
            require 'like_button.php'; // like_button.phpを読み込む
            ?>
            <hr>
        <?php
        } ?>
    </div>
</main>

<script>
    function check(id) {
        document.getElementById(id).checked = true;
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

<?php require_once __DIR__ . '/footer.php'; ?>
</body>

</html>