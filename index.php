<?php
if (!isset($kiji)) {
    require_once __DIR__ . '/kiji.php';
    $kiji = new Report();
}

if (!isset($tag)) {
    require_once __DIR__ . '/tags.php';
    $tags = new Tag();
}

if (!isset($us)) {
    require_once __DIR__ . '/user.php';
    $us = new User();
    $ur = new UR();
}

if (isset($_POST["Filter"]) && $_POST["Filter"] != 0) {
    $Filter = $_POST["Filter"];
}

if (!isset($Filter)) { //$Filterが空なら全て表示する
    $showKiji = $kiji->showAllReports();
} else {
    $showKiji = $tags->sortTagR($Filter);
}
$showTags = $tags->showTags();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>プログラミング情報共有サイト（仮）</title>
    <link href="main.css" rel="stylesheet">
    <script src="index.js" defer></script>
    <?php
    require_once __DIR__ . '/header.php';
    ?>
</head>

<style>
    a.que {
        float: right;
        border-radius: 5px;
        background-color: #007BFF;
        padding: 10px;
        text-decoration: none;
        color: white;
    }

    a[href="#kiji1"],
    a[href="#kiji2"],
    a[href="#kiji3"] {
        color: blue;
        width: 500px;
        margin-top: 0;
        font-weight: bold;
    }


    .title {
        font-weight: bold;
        line-height: 2;
        color: #000000;
        margin: 10px;
    }

    p {
        font-weight: bold;
    }

    th,
    td {
        border: solid 1px;
        /* 枠線指定 */
        padding: 10px;
        /* 余白指定 */
    }

    table {
        margin-left: 5px;
        color: black
    }

    .frame-article {
        padding: 10px;
        width: 450px;
        margin-bottom: 10px;
        border: 1px solid #333333;
        border-radius: 10px;
    }

    .frame-tag {
        padding: 1px;
        width: 80px;
        margin-bottom: 1px;
        border: 1px solid #333333;
    }

    .button {
        background-color: #fff;
        border-color: #fff;
        margin-left: 5px;
    }

    p.tag {
        border: 1px solid;
        display: inline-block;
        border-radius: 20px;
        background-color: #ccc;
    }

    #a1 {
        color: #007BFF;
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

    /* .filter {
        width: 120px;
        height: 42px;
        padding: 10px;
        margin: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    } */

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


    /* ボタンの微調整 */
    /* Button styling */
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

    .textarea {
        resize: none;
        text-align: center;
    }

    .upload {
        text-align: right;
        float: right;
        margin: 10px;
    }

    /* Article styling */
    .articles {
        margin-top: 20px;
    }

    .kiji {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
    }

    .kiji h2 {
        color: #007BFF;
        margin: 10px 0;
    }

    p.tag {
        display: inline-block;
        background-color: #e9ecef;
        color: #333;
        padding: 5px 10px;
        border-radius: 15px;
        margin: 10px 0;
    }

    .kiji .extra {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .kiji #date {
        font-size: 14px;
        color: #666;
    }

    .extra {
        display: flex;
        align-items: center;
    }

    #kijidata {
        color: #4267b2;
    }

    #date {
        margin-left: 200px;
    }

    .UserName {
        font-size: 15px;
        color: #878787;
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
</style>




<body>

    <div class="main">
        <div class="main_con">

            <h2 class="title">記事一覧</h2>

            <div class="upload">
                <input class="button" onclick="location.href='repin.php'" type="button" value="記事を投稿する">
            </div>
            <div class="filter">
                <!-- 絞り込み機能追加 -->
                <select>
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
            </div>
            <br>
            <hr>
            <div class="articles">

                <?php
                function sortByDateTime($a, $b)
                {
                    // 日を比較する
                    $dateComparison = strcmp($b['D'], $a['D']); // 降順に並び替える
                    if ($dateComparison != 0) {
                        return $dateComparison;
                    }
                    // もし日が同じであれば、時刻を比較します。
                    return strcmp($b['Tim'], $a['Tim']); //降順に並び替える
                }

                // 並び変えた結果を表示します
                usort($showKiji, 'sortByDateTime');

                if (empty($showKiji)) { // 記事がない場合
                    echo '<h4>記事はありません';
                } else {
                    foreach ($showKiji as $showReport) {
                        //記事IDからタグを取得する
                        $rtag = $tags->showTagR($showReport['RepoID']);
                        $rid = $ur->selectURlink($showReport['RepoID']);
                        $ru = $us->tokuteiUser($rid['UsID']);
                ?>
                        <section class="kiji">
                            <form method="post" name="kiji" action="ndet.php">
                                <input type="hidden" name="kijiID" value="<?= $showReport['RepoID'] ?>">
                                <h2 id="kijidata"><?php echo htmlspecialchars($showReport['Title'], ENT_QUOTES); ?></h2>
                                <p class="UserName"><?= $ru['UsName'] ?></p>
                                <p class="tag"># <?= $rtag['TagName'] ?></p>
                                <div class="extra">
                                    <input class="submit" type="submit" value="詳細" id="more">
                                    <p id="date"><?= $showReport['D'] ?> <?= substr($showReport['Tim'], 0, 5) ?></p>
                                </div>
                            </form>
                        </section>

                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    require_once  __DIR__ . '/footer.php';  // footer.phpを読み込む	
    ?>
</body>

</html>