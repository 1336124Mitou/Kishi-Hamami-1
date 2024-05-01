<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment List</title>
    <style>
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
            width: 100%;
            padding: 10px;
            font-size: 14px;
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
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // データベース接続設定
        $host = 'localhost'; // データベースのホスト名
        $db   = 'kishi'; // 作成したデータベース名
        $user = 'Kishi'; // データベースユーザー名
        $pass = 'hamami'; // データベースパスワード
        $charset = 'utf8mb4';

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

        <!-- コメント入力用のモーダル -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="commentForm" action="ndet2.php" method="post">
                    <textarea name="comment" placeholder="コメントを入力してください" required></textarea>
                    <button type="submit">コメントする</button>
                </form>
            </div>
        </div>

        <button id="openModalBtn">コメントを入力する</button>
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

        // モーダル外をクリックした時に閉じる
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // モーダルの閉じるボタンをクリックした時に閉じる
        var closeBtn = document.querySelector(".close");
        closeBtn.onclick = function() {
            closeModal();
        };

        // コメント入力用のモーダルを開くボタンのイベントリスナー
        var openModalBtn = document.getElementById("openModalBtn");
        openModalBtn.onclick = function() {
            openModal();
        };

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