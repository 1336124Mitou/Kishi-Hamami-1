<?php
require 'dbdata.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['userId'];
$rep_id = $data['repID'];
$liked = $data['liked'] ? 1 : 0;

$db = new Dbdata();

try {
    if ($liked) {
        // いいねを追加
        $sql = "INSERT INTO Likes (UsID, RepID) VALUES (?, ?)";
        $params = [$user_id, $rep_id];
    } else {
        // いいねを削除
        $sql = "DELETE FROM Likes WHERE UsID = ? AND RepID = ?";
        $params = [$user_id, $rep_id];
    }

    $stmt = $db->exec($sql, $params);

    if ($stmt) {
        // 新しいいいね数を取得
        $result = $db->query("SELECT COUNT(*) AS like_count FROM Likes WHERE RepID = ?", [$rep_id]);
        $row = $result->fetch();
        echo json_encode(["status" => "success", "likeCount" => $row['like_count']]);
    } else {
        throw new Exception("Database operation failed.");
    }
} catch (Exception $e) {
    error_log($e->getMessage()); // ログにエラーメッセージを記録
    echo json_encode(["status" => "error", "message" => "An error occurred while processing your request."]);
}
