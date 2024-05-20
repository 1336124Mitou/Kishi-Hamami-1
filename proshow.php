<?php
session_start();
// セッションにデータが無ければログイン画面に遷移する
if (empty($_SESSION['userId'])) {
    header('Location: login.php');
    exit();
}

// フォームから送信されたデータを処理する
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを取得する
    $projectName = $_POST["projectName"];
    $projectDescription = $_POST["projectDescription"];
    $userID = $_POST["userID"];

    // ファイルがアップロードされた場合、一時ファイルの場所を取得する
    if (isset($_FILES["project"]) && $_FILES["project"]["error"] == UPLOAD_ERR_OK) {
        $projectFile = file_get_contents($_FILES["project"]["tmp_name"]);
    } else {
        die("ファイルアップロードエラー");
    }

    // データベースに接続するための情報
    $servername = "localhost";
    $username = "Kishi";
    $password = "hamami";
    $dbname = "kishi";

    // データベースに接続
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続をチェック
    if ($conn->connect_error) {
        die("接続失敗: " . $conn->connect_error);
    }

    // ファイルをデータベースに保存する例
    $sql = "INSERT INTO Project (ProName, Proexample, ProjFile) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // プレースホルダーに変数をバインド
    $stmt->bind_param("sss", $projectName, $projectDescription, $projectFile);

    if ($stmt->execute() === TRUE) {
        $projectID = $stmt->insert_id; // 最後に挿入されたプロジェクトのIDを取得
        echo "新しいレコードが正常に作成されました";

        // `UPlink`テーブルに関連付けを挿入
        require_once __DIR__ . '/user.php';
        $UP = new UP();
        $UP->insertUPlink($userID, $projectID);
    } else {
        echo "エラー: " . $stmt->error;
    }

    // データベースとの接続を閉じる
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>制作物公開</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 20px;
        }

        form {
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
            left: -20px;
        }

        div {
            margin-bottom: 20px;
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
        }

        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            resize: none;
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            position: relative;
            left: -8px;
        }

        .link {
            position: relative;
            top: 20px;
            left: -15px;
        }
    </style>
</head>

<body>
    <h1>制作物公開</h1>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <!-- ユーザーのIDを取得する -->
            <input type="hidden" name="userID" value="kd1@gmail.com">
            <div class="form-group">
                <label for="projectName">作品名:</label>
                <input type="text" id="projectName" name="projectName" required>
            </div>
            <div class="form-group">
                <label for="projectDescription">作品説明:</label>
                <textarea id="projectDescription" name="projectDescription" rows="4" required></textarea>
            </div>
            <div>
                <input type="file" name="project" required accept=".zip,.pdf,.txt">
            </div>
            <!-- ファイル名を表示するためのスパン -->
            <span class="file-name" id="fileName"></span>
            <div>
                <input type="submit" value="送信する">
            </div>
        </form>
        <div class="link">
            <a href="Allproject.php">制作物一覧</a>
            <a href="index.php">ホーム</a>
        </div>
    </div>
    <script>
        // ファイル名を表示する関数
        document.querySelector('input[name="project"]').addEventListener('change', function(e) {
            const fileName = e.target.files[0].name;
            document.getElementById('fileName').textContent = '選択されたファイル: ' + fileName;
        });
    </script>
</body>

</html>