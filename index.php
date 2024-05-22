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

    h2 {
        font-weight: bold;
        line-height: 2;
        color: #000000;
        margin: 25px 0;
    }

    p {
        font-weight: bold;
        line-height: 2;
        color: #333;
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

    button {
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

    /* Container styling */
    .main {
        width: 80%;
        /* 幅を指定 */
        max-width: 1200px;
        /* 最大幅を指定 */
        margin: 0 auto;
        /* 自動的に中央に配置 */
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .filter {
        width: 120px;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* ボタンの微調整 */
    /* Button styling */
    input.button,
    button {
        display: inline-block;
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input.button:hover,
    button:hover {
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
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .kiji h2 {
        color: #007BFF;
        margin: 10px 0;
    }

    .kiji p.tag {
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
</style>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>プログラミング情報共有サイト（仮）</title>
    <link href="main.css" rel="stylesheet">
    <script src="index.js" defer></script>
</head>

<body>
    <?php
    require_once __DIR__ . '/header.php';
    ?>

    <div class="main">
        <div class="main_con">
            <div class="upload">
                <input class="button" onclick="location.href='repin.php'" type="button" value="記事投稿">
            </div>
            <h2>記事一覧</h2>

            <!-- 絞り込み機能追加 -->
            <select class="filter">
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
            <br>
            <hr>
            <div class="articles">

                <br>
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
                                    <input type="submit" value="詳細" id="more">
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