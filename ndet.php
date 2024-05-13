<?php
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

if (isset($_POST["kijiID"])) {
    $report_id = $_POST["kijiID"];
}

$showkiji = $kiji->showReport($report_id);
$showComments = $comment->showAllAnswer($report_id);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="popup.css">
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
            width: 80%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        .comment-form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
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
    </style>

    <script>
        function check(id) {
            document.getElementById(id).checked = true;
        }
    </script>
</head>

<body>
    <?php
    require_once __DIR__ . '/header.php';
    ?>

    <h1><?= $showkiji['Title']?></h1>
    <form id="form1"><?= $showkiji['Info']?></form>
    <main>
        <div class="frame">
            <h2>回答</h2>
            <?php
            foreach ($showComments as $showComment) {
            ?>


                <p><?= $showComment['Reply'] ?></p>
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
                        <input type="hidden" name="RepoID" value="<?= $report_id ?>">
                        <div class="post">
                            <input class ="submit" type="submit" value="投稿">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>