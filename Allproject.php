<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
    <link href="main.css" rel="stylesheet">
    <style>
    .main {
    padding: 20px;
}

h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #000000;
}

.project-item {
    background-color: #7e7e7e;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
}

.project-item h3 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #000000;
}

.project-item p {
    font-size: 16px;
    color: #333333;
}
</style>
</head>

<body>
<?php
   require_once __DIR__ . '/header.php';
   ?>
    <div class="main">
        <h2>制作物一覧</h2>
        <div class="project-list">
            <?php
            // データベースから制作物の情報を取得する処理を書く
            // ここではダミーデータを使用しています
            $projects = [
                ["title" => "制作物1のタイトル", "description" => "制作物1の説明や詳細などがここに入ります。"],
                ["title" => "制作物2のタイトル", "description" => "制作物2の説明や詳細などがここに入ります。"],
                ["title" => "制作物3のタイトル", "description" => "制作物3の説明や詳細などがここに入ります。"],
                ["title" => "制作物4のタイトル", "description" => "制作物4の説明や詳細などがここに入ります。"]
            ];

            // 制作物の一覧を表示
            foreach ($projects as $project) {
                echo "<div class='project-item'>";
                echo "<h3>" . $project['title'] . "</h3>";
                echo "<p>" . $project['description'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
        <a href="proshow.php">制作物公開へ</a>
    </div>
</body>

</html>
