<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($comment)) {
    require_once __DIR__ . '/comment.php';
    $comment = new Comment();
}

if (!isset($tags)) {
    require_once __DIR__ . '/tags.php';
    $tags = new Tag();
}

if (!isset($kiji)) {
    require_once __DIR__ . '/kiji.php';
    $kiji = new Report();
}

if (!isset($likeR)) {
    require_once __DIR__ . '/likeR.php';
    $likeR = new LikeRepo();
    $likeCom = new LikeCom();
}

if (!isset($user)) {
    require_once __DIR__ . '/user.php';
    $user = new UR();
}

if (isset($_POST["kijiID"])) {
    $kijiID = $_POST["kijiID"];
}

if (isset($_GET["kijiID"])) {
    $kijiID = $_GET["kijiID"];
}

$like = $likeR->showLikeR($kijiID);
$likec;

$showkiji = $kiji->showReport($kijiID);
$showComments = $comment->showAllAnswer($kijiID);

$userCheck = $user->selectURlink($kijiID);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="popup.css">
    <?php
    require_once __DIR__ . '/header.php';
    ?>
    <title>記事</title>
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

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .container {
            width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comment {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment .user {
            font-weight: bold;
            color: #333;
        }

        .comment .text {
            color: #555;
        }

        .comment .timestamp {
            font-size: 12px;
            color: #999;
        }

        /* モーダル */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .comment-form textarea,
        .textarea textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            box-sizing: border-box;
        }

        .comment-form button {
            margin-top: 10px;
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }

        /* クリックでオーバーレイ表示 */
        #popup:checked~#overlay {
            visibility: visible;
        }

        #popup:checked~#overlay #window {
            animation: fadein 500ms forwards;
            animation-timing-function: ease-in-out;
        }

        .checkbox {
            display: none;
        }

        .likenum {
            text-align: center;
        }

        .likebutton {
            display: block;
            margin: auto;
        }

        .top {
            text-align: center;
        }

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

        .post {
            text-align: right;
            float: right;
            margin: 10px;
        }

        input.submit {
            display: inline-block;
            color: #fff;
            background: #007BFF;
            border-radius: 20px;
            padding: 0.5em 1.5em;
            border-color: #007BFF;
        }

        .textarea {
            resize: none;
            text-align: center;
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

        .infor {
            display: flex;
            align-items: center;
            /* 垂直方向に中央揃え */
            justify-content: space-between;
            /* 子要素間のスペースを均等に配置 */
        }

        .likenumtwo {
            margin-right: 10px;
            /* 必要に応じて余白を調整 */
        }

        .likestwo {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
        }

        .likestwo:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        function check(id) {
            document.getElementById(id).checked = true;
        }

        function likeReport(repoID, userId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "likeRadd.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // 良いね数の表示を更新する
                        document.getElementById('likesDisplay').innerText = response.newLikeCount;
                    } else {
                        console.error("Error: " + response.message);
                    }
                } else if (xhr.readyState === 4) {
                    console.error("Error: " + xhr.status + " " + xhr.statusText);
                }
            };
            xhr.send("RepoID=" + encodeURIComponent(repoID) + "&UserID=" + encodeURIComponent(userId));
        }

        function likeAnswer(repID, userId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "likeRepadd.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('likeDisplaytwo' + repID).innerText = response.newLikeCount;
                    } else {
                        console.error("Error: " + response.message);
                    }
                } else if (xhr.readyState === 4) {
                    console.error("Error: " + xhr.status + " " + xhr.statusText);
                }
            };
            xhr.send("ReplyID=" + encodeURIComponent(repID) + "&UserID=" + encodeURIComponent(userId));
        }

    </script>
</head>

<body>

    <div class="honbun">

        <?php
        //ログインしているユーザーと記事を投稿したユーザーが同じなら削除ボタンを表示する
        if ($_SESSION['userId'] == $userCheck['UsID']) {
        ?>
            <!-- 削除ボタン -->
            <div class="delete-button">
                <form method="POST" action="kijidelete.php" onsubmit="return confirm('本当に削除しますか？');">
                    <input type="hidden" name="kijiID" value="<?= $kijiID ?>">
                    <input type="submit" value="削除">
                </form>
            </div>
        <?php
        }
        ?>
        <h1><?php echo htmlspecialchars($showkiji['Title'], ENT_QUOTES); ?></h1>
        <form id="form1"><?php echo nl2br(htmlspecialchars($showkiji['Info'], ENT_QUOTES)); ?></form>
        <br>
    </div>
    <div class="like">
        <!-- いいねボタン -->
        <p class="likenum" id="likesDisplay"><?= $like["LNum"] ?></p>
        <input type="hidden" name="ReplyID" value="<?= $showkiji['RepoID'] ?>">
        <button type="submit" class="likebutton" onclick="likeReport(<?= $showkiji['RepoID'] ?>, '<?= $_SESSION['userId'] ?>')">いいね！</button>
    </div>
    <main>
        <div class="frame">
            <h2>コメント</h2>
            <?php
            foreach ($showComments as $showComment) {
                $likec = $likeCom->showLikeRep($showComment['RepID']);
            ?>

                <p><?= $showComment['Reply'] ?></p>

                <p class="date"><?= $showComment['D'] ?> <?= substr($showComment['Tim'], 0, 5) ?></p>
                <!-- for later/後で追加 -->
                <div class="infor">
                    <p class="likenumtwo" id="likeDisplaytwo<?= $showComment['RepID'] ?>"><?= $likec["LNum"] ?></p>
                    <button type="submit" class="likestwo" onclick="likeAnswer(<?= $showComment['RepID'] ?>, '<?= $_SESSION['userId'] ?>')">いいね！</button>
                </div>
                <hr>

            <?php
            }
            ?>
            <input class="button" onclick="check('popup');" type="button" value="コメント追加">

        </div>

    </main>

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
                <form method="POST" action="commentadd.php">
                    <h2>コメント投稿</h2>
                    <div class="textarea">
                        <textarea id="answer" name="Com" rows="5" cols="70" required></textarea><br><br>
                        <input type="hidden" name="RepoID" value="<?= $kijiID ?>">
                        <div class="post">
                            <input class="submit" type="submit" value="投稿">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once  __DIR__ . '/footer.php';  // footer.phpを読み込む	
    ?>
</body>

</html>