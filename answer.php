<?php
// フォームから送信されたデータを処理する
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを取得する
    $answer = $_POST["answer"];
    $question_id = $_POST["question_id"]; // 質問のIDを取得する

    // データベースに接続するための情報
    $servername = "localhost";
    $username = "Kishi";
    $password = "hamami";
    $dbname = "kishi";

    // データベースに接続
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続をチェック
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 回答をデータベースに保存する処理
    $sql = "INSERT INTO answers (question_id, answer) VALUES ('$question_id', '$answer')";

    if ($conn->query($sql) === TRUE) {
        echo "回答が送信されました。";
    } else {
        echo "エラー: " . $sql . "<br>" . $conn->error;
    }

    // データベースとの接続を閉じる
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>回答する</title>
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

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group textarea {
            resize: vertical; /* テキストエリアの垂直方向のリサイズを有効にする */
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>質問に回答する</h1>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="answer">回答:</label>
                <textarea id="answer" name="answer" rows="4" required></textarea>
            </div>

            <!-- 質問のIDをhiddenフィールドとしてフォームに含める -->
            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">

            <div>
                <input type="submit" value="送信する">
            </div>
        </form>
    </div>
</body>
</html>
