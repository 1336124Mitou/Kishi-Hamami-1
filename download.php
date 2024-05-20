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

// 制作物のファイル名をデータベースから取得するSQLクエリ
$sql = "SELECT ProjFile FROM project WHERE ProID = $proID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['ProjFile']; // 制作物のファイルパス
    $fileName = basename($filePath); // ファイル名を取得

    // ファイルが存在するかどうかを確認する
    if (file_exists($filePath)) {
        $fileSize = filesize($filePath); // ファイルサイズを取得
        // ファイルの種類を取得する
        $fileType = mime_content_type($filePath);

        // ダウンロード用のヘッダーを設定する
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $fileType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $fileSize);

        // ファイルを読み込んで出力する
        readfile($filePath);

        // スクリプトを終了する
        exit;
    } else {
        // ファイルが存在しない場合はエラーメッセージを出力する
        die("ファイルが見つかりませんでした");
    }
} else {
    // 制作物が存在しない場合はエラーメッセージを出力して終了する
    die("制作物が見つかりませんでした");
}

// データベース接続を閉じる
$conn->close();
?>
