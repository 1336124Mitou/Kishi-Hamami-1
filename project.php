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

// 制作物のIDを取得
$proID = $_GET['id'];

// 制作物の情報を取得するSQLクエリ
$sql = "SELECT * FROM Project WHERE ProID = $proID"; // テーブル名が "Project" であることを前提とします
$result = $conn->query($sql);

// 制作物の情報を格納する変数
$project = [];

// 制作物が存在するかチェック
if ($result->num_rows > 0) {
    $project = $result->fetch_assoc();
} else {
    // 制作物が存在しない場合はエラーメッセージを表示して終了
    die("制作物が見つかりませんでした");
}

// データベース接続を閉じる
$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?php echo $project['ProName']; ?>の詳細</title>
    <link href="main.css" rel="stylesheet">
    <!-- ここに必要なCSSファイルを追加する場合があります -->
</head>
<style>
.main {
    padding: 20px;
}

.project-details {
    background-color: #f1f1f1;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.project-details h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333333;
}

.project-details p {
    font-size: 16px;
    line-height: 1.6;
    color: #555555;
}

.project-details a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.project-details a:hover {
    text-decoration: underline;
}
    </style>
<body>
<?php require_once __DIR__ . '/header.php'; ?>
    <div class="main">
        <h2><?php echo $project['ProName']; ?>の詳細</h2>
        <div class="project-details">
            <p><strong>制作物名:</strong> <?php echo $project['ProName']; ?></p>
            <p><strong>制作物説明:</strong> <?php echo $project['Proexample']; ?></p>
            <p><strong>制作物ファイル:</strong> <a href="download.php?id=<?php echo $project['ProID']; ?>">ダウンロード</a></p>
            <!-- 制作物の詳細情報を表示するための他の要素をここに追加することができます -->
        </div>
    </div>
</body>

</html>
