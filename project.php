<?php
// データベース接続などの設定

$servername = "localhost";
$username = "Kishi";
$password = "hamami";
$dbname = "kishi";

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// 制作物のIDを取得
$proID = $_GET['id'];

// 制作物の情報を取得するSQLクエリ
$sql = "SELECT * FROM Project WHERE ProID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proID);
$stmt->execute();
$result = $stmt->get_result();

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
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($project['ProName'], ENT_QUOTES, 'UTF-8'); ?>の詳細</title>
    <link href="main.css" rel="stylesheet">
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

        .button {
            border: 1px solid;
            width: 150px;
            height: 35px;
            font-size: 15px;
            align-self: center;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #007BFF;
            margin-bottom: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .delete {
            background: #dc3545; /* Red color for delete button */
        }

        .submit:hover,
        .delete:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <div class="main">
        <h2><?php echo htmlspecialchars($project['ProName'], ENT_QUOTES, 'UTF-8'); ?>の詳細</h2>
        <div class="project-details">
            <p><strong>制作物名:</strong> <?php echo htmlspecialchars($project['ProName'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>制作物説明:</strong> <?php echo htmlspecialchars($project['Proexample'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>制作物ファイル:</strong> <a href="download.php?id=<?php echo htmlspecialchars($project['ProID'], ENT_QUOTES, 'UTF-8'); ?>">ダウンロード</a></p>
            <!-- 制作物の詳細情報を表示するための他の要素をここに追加することができます -->
        </div>
        <form method="post" action="delete_project.php" onsubmit="return confirm('本当に削除しますか？');">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($project['ProID'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="submit" value="削除" class="button delete">
            </form>
    </div>
</body>

</html>

