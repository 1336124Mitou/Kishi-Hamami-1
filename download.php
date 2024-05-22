<?php
// データベース接続設定
$servername = "localhost";
$username = "Kishi";
$password = "hamami";
$dbname = "kishi";

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// 制作物IDの取得
$proID = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($proID <= 0) {
    die("無効な制作物IDです");
}

// 制作物のファイルパスを取得するSQLクエリ
$sql = "SELECT ProjFile FROM Project WHERE ProID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proID);
$stmt->execute();
$result = $stmt->get_result();

// ファイルが存在するかチェック
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['ProjFile'];

    // ファイルが存在するかチェック
    if (file_exists($filePath)) {
        // ファイルのダウンロード処理
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "ファイルが見つかりませんでした";
    }
} else {
    echo "制作物が見つかりませんでした";
}

// データベース接続を閉じる
$stmt->close();
$conn->close();
?>

