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

// 制作物の情報を取得するSQLクエリ
$sql = "SELECT * FROM Project";
$result = $conn->query($sql);

// 取得した制作物の情報を配列に格納
$projects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
        .project-item {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .project-item h2 {
            color: #4267b2;
        }
        .project-item a {
            color: #4267b2;
            text-decoration: none;
        }
        footer {
            background-color: #f4f4f4;
            padding: 10px 20px;
            text-align: center;
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
        .que {
            text-align: right;
            float: right;
            margin: 10px;
        }
        .textarea {
            resize: none;
            text-align: center;
        }
        .submit, .delete {
            display: inline-block;
            color: #fff;
            border-radius: 20px;
            padding: 0.5em 1.5em;
            border: none;
            cursor: pointer;
        }
        .submit {
            background: #007BFF;
        }
        .submit:hover {
            opacity: 0.7;
        }
        .delete {
            background: #FF0000;
        }
        .delete:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <div class="main">
        <div class="show">
            <input class="button" onclick="location.href='proshow.php'" type="button" value="制作物公開へ">
        </div>
        <h2>制作物一覧</h2>
        <div class="project-list">
            <?php
            // 制作物の一覧を表示
            foreach ($projects as $project) {
                echo "<div class='project-item'>";
                echo "<h2>" . htmlspecialchars($project['ProName'], ENT_QUOTES, 'UTF-8') . "</h2>";
                echo "<p>" . htmlspecialchars($project['Proexample'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<form method='get' action='project.php' style='display:inline-block;'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($project['ProID'], ENT_QUOTES, 'UTF-8') . "'>";
                echo "<input type='submit' value='詳細' class='submit'>";
                echo "</form>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <?php require_once __DIR__ . '/footer.php'; ?>
</body>
</html>

