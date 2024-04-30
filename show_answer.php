<?php
// データベース接続などの設定

// データベースに接続
$servername = "localhost";
$username = "Kishi";
$password = "hamami";
$dbname = "kishi";

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続をチェック
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// 質問のIDを取得
$question_id = $_GET['question_id'];

// 質問に関連する回答を取得するクエリを作成
$sql = "SELECT * FROM Reply WHERE QuestionID = $question_id";
$result = $conn->query($sql);

// 回答が存在するかチェック
if ($result->num_rows > 0) {
    // 回答を表示
    while($row = $result->fetch_assoc()) {
        echo "<h2>回答</h2>";
        echo "<p>" . $row["Reply"] . "</p>";
    }
} else {
    echo "回答はありません";
}

// データベース接続を閉じる
$conn->close();
?>

