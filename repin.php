<?php
if (!isset($kiji)) {
    require_once __DIR__ . '/kiji.php';
    $kiji = new Report();
}

if (!isset($tags)) { // $tagに必ずtagオブジェクトをセットするため
    require_once __DIR__ . '/tags.php';
    $tags = new Tag();
}

$showTags = $tags->showTags();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>記事投稿</title>
    <style>
        .okuru {
            text-align: center;
        }

        #Title {
            width: 80%;
            /* 画面幅の80%に設定 */
            resize: none;
        }

        #report {
            width: 80%;
            /* 画面幅の80%に設定 */
            height: 300px;
            /* 高さは固定 */
            resize: none;
        }

        .link {
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
    </style>
</head>

<body>
    <div class="okuru">
        <!-- ページのタイトル -->
        <h1>記事投稿</h1>

        <form method="POST" action="kijiadd.php">
            <!-- ユーザーのIDを取得する -->
            <input type="hidden" name="userID" value="kd1@gmail.com">
            <!-- 記事タイトル入力 -->
            <h4>記事のタイトル</h4>
            <textarea id="Title" name="Title" placeholder="ここに記事のタイトルを書いてください" required></textarea>

            <!-- 記事入力 -->
            <h4>記事内容</h4>
            <textarea id="report" name="RDet" placeholder="ここに記事を入力してください。" oninput="changeTextColor(this)" required></textarea><br>

            <!-- タグ選択するコンボボックス -->
            <h4>タグの選択</h4>
            <select name="RTag">
                <?php
                foreach ($showTags as $showtag) {
                ?>
                    <option value="<?= $showtag['TagID'] ?>"><?= $showtag['TagName'] ?></option>
                <?php
                }
                ?>
            </select><br><br>

            <input class="button" type="submit" value="投稿">
        </form>
    </div>
    <div class="link">
        <br>
        <a href="index.php">ホーム</a>
    </div>
</body>

</html>