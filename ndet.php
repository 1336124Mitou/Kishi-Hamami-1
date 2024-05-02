<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment List</title>
    <style>
        /* 記事 */
        #form1 {
            width: 500px;
            height: 600px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h1,
        h2 {
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .container {
            width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comment {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment .user {
            font-weight: bold;
            color: #333;
        }

        .comment .text {
            color: #555;
        }

        .comment .timestamp {
            font-size: 12px;
            color: #999;
        }

        /* モーダル */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .comment-form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .comment-form button {
            margin-top: 10px;
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .comment-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    require_once __DIR__ . '/header.php';
    ?>

    <h1>テンプレート</h1>
    <form id="form1"></form>
    <div class="container">
        <?php
        // データベース接続設定
        $host = 'localhost'; // データベースのホスト名
        $db   = 'kishi'; // 作成したデータベース名
        $user = 'Kishi'; // データベースユーザー名
        $pass = 'hamami'; // データベースパスワード
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        // データベース接続
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        // コメントをデータベースに挿入
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment"])) {
            $comment = $_POST["comment"];
            if ($comment !== "こんにちは") {
                $currentDateTime = date("Y-m-d H:i:s"); // 現在の日時を取得

                $stmt = $pdo->prepare("INSERT INTO Report (Info, D, Tim) VALUES (:comment, :currentDate, :currentTime)");
                $stmt->bindParam(':comment', $comment);
                $stmt->bindParam(':currentDate', date("Y-m-d")); // 日付の形式を変更
                $stmt->bindParam(':currentTime', date("H:i:s")); // 時刻の形式を変更
                $stmt->execute();
            }
        }


        // コメント取得
        $stmt = $pdo->prepare('SELECT RepoID, Info, D, Tim FROM Report');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            echo '<div class="comment">';
            echo '<span class="text">' . htmlspecialchars($row['Info']) . '</span>';
            echo '<span class="timestamp">- ' . htmlspecialchars($row['D']) . ' ' . htmlspecialchars($row['Tim']) . '</span>';
            echo '</div>';
        }
        ?>

        <!-- コメント入力 -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form id="commentForm" action="ndet2.php" method="post" class="comment-form">
                    <textarea name="comment" placeholder="コメントを入力してください" required></textarea>
                    <button type="submit">投稿</button>
                </form>
            </div>
        </div>

        <button id="openModalBtn" onclick="openModal()">コメント入力</button>
    </div>

    <script>
        // モーダルを表示するための関数
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        // モーダルを閉じるための関数
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        // コメント入力フォームの送信後にページをリロード
        document.getElementById("commentForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                    method: form.method,
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    location.reload(); // ページをリロードしてコメントを表示
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

</body>

</html>