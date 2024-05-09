<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
    // 回答のIDを取得
    $answer_id = $_POST['answer_id'];

    // データベースに接続
    $dsn = 'mysql:host=localhost;dbname=your_database;charset=utf8';
    $user = 'your_username';
    $password = 'your_password';

    try {
        $connection = new PDO($dsn, $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 回答のいいね数を更新
        $update_query = "UPDATE kaitou SET likes = likes + 1 WHERE AnswerID = ?";
        $stmt = $connection->prepare($update_query);
        $stmt->bindParam(1, $answer_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    // いいねが更新された後、回答の詳細ページにリダイレクトするなどの処理を追加することもできます
    // header("Location: answer_detail.php?id=$answer_id");
}
