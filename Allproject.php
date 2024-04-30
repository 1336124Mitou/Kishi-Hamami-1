<?php
// データベース接続などの設定

// データベースへの接続
$servername = "localhost";
$username = "Kishi";
$password = "hamami";
$dbname = "kishi";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// 制作物の情報を取得するSQLクエリ
$sql = "SELECT * FROM Project"; // テーブル名が "Project" であることを前提とします
$result = $conn->query($sql);

// 取得した制作物の情報を配列に格納
$projects = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

// データベース接続を閉じる
$conn->close();
?>

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
<?php require_once __DIR__ . '/header.php'; ?>
    <div class="main">
        <h2>制作物一覧</h2>
        <div class="project-list">
            <?php
            // 制作物の一覧を表示
            foreach ($projects as $project) {
                echo "<div class='project-item'>";
                echo "<h3>" . $project['ProName'] . "</h3>"; // テーブル内の列名を適切に変更します
                echo "<p>" . $project['Proexample'] . "</p>"; // テーブル内の列名を適切に変更します
                echo "</div>";
            }
            ?>
        </div>
        <a href="proshow.php">制作物公開へ</a>
    </div>
</body>

</html>


