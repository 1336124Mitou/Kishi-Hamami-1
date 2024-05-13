<?php
if (!isset($kiji)) {
    require_once __DIR__ . '/kiji.php';
    $kiji = new Report();
}
if (!isset($tag)) {
    require_once __DIR__ . '/tags.php';
    $tags = new Tag();
}
$showKiji = $kiji->showAllReports();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>プログラミング情報共有サイト（仮）</title>
    <link href="main.css" rel="stylesheet">
    <script src="index.js" defer></script>
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

    .kiji {
        margin-left: 13px;
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
</style>

<body>
    <?php
    require_once __DIR__ . '/header.php';
    ?>

    <div class="main">
        <div class="main_con">
            <h2>記事一覧</h2>
            <!-- 絞り込み機能追加 -->
            <input type="text" id="filterInput" oninput="filterArticles(this.value)" placeholder="絞り込み" style="width: 300px;height: 40px;">
            <br>
            <p>並べ替え</p>
            <!--並べ替え機能 ここから-->
            <button onclick="sortArticles('tags')">タグで並べ替え</button>
            <button onclick="sortArticlesByTitle()">タイトルで並べ替え</button>
            <button onclick="sortArticles('day')">日付で並べ替え</button>
            <!--並べ替え機能 ここまで-->
            <hr>
            <div class="articles">
                <input class="button" onclick="location.href='repin.php'" type="button" value="記事公開">
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
                ?>
                        <section class="kiji">
                            <form method="post" name="kiji" action="ndet.php">
                                <input type="hidden" name="kijiID" value="<?= $showReport['RepoID'] ?>">
                                <h2 id="kijidata"><?= $showReport['Title'] ?></h2>
                                <p class="tag"># <?= $rtag['TagName'] ?></p>
                                <div class="extra">
                                    <input type="submit" value="詳細" id="more">
                                    <p id="date"><?= $showReport['D'] ?> <?= $showReport['Tim'] ?></p>
                                </div>
                            </form>
                        </section>
                        <hr>

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