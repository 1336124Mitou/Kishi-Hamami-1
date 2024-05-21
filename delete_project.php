<?php
// セッションの開始
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ログインチェック
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$username = "Kishi";
$password = "hamami";
$dbname = "kishi";

// データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectId = $_POST['id'];

    // トランザクション開始
    $conn->begin_transaction();

    try {
        // `uplink`テーブルから関連するエントリを削除
        $stmt = $conn->prepare("DELETE FROM uplink WHERE ProID = ?");
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $stmt->close();

        // `project`テーブルから制作物を削除
        $stmt = $conn->prepare("DELETE FROM Project WHERE ProID = ?");
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $stmt->close();

        // トランザクションをコミット
        $conn->commit();

        echo "制作物が削除されました。";
    } catch (mysqli_sql_exception $exception) {
        // エラーが発生した場合、トランザクションをロールバック
        $conn->rollback();

        // エラーメッセージを表示
        echo "制作物の削除に失敗しました: " . $exception->getMessage();
    }
}

$conn->close();

// リダイレクト
header('Location: index.php');
exit;
?>
