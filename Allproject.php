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
      main {
            padding: 20px;
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

        .que {
            text-align: right;
            float: right;
            margin: 10px;
        }

        .textarea {
            resize: none;
            text-align: center;
        }

        input.submit {
            display: inline-block;
            color: #fff;
            background: #007BFF;
            border-radius: 20px;
            padding: 0.5em 1.5em;
            border-color: #007BFF;
        }

        input.submit:hover {
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
                echo "<h2>" . $project['ProName'] . "</h2>";
                echo "<p>" . $project['Proexample'] . "</p>";
                echo "<form method='get' action='project.php'>";
                echo "<input type='hidden' name='id' value='" . $project['ProID'] . "'>";
                echo "<input type='submit' value='詳細'>";
                echo "</form>";
                echo "</div>";
            }
            ?>
            
        </div>
    </div>
    <?php
    require_once  __DIR__ . '/footer.php';  // footer.phpを読み込む	
    ?>
</body>

</html>

