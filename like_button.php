<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>いいねボタン</title>
    <style>
        .like-container {
            display: flex;
            align-items: center;
        }

        .like-button {
            font-size: 24px;
            background: none;
            border: none;
            /* 枠を消す */
            cursor: pointer;
            color: gray;
        }


        .like-button.liked {
            color: pink !important;
            /* ピンク色に変更 */
        }


        #likeCount {
            margin-left: 8px;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <?php
    require 'dbdata.php';

    $db = new Dbdata();

    // いいね数の取得（例として特定のRepID = 1の回答に対するいいねを取得）
    $repID = 1;
    $result = $db->query("SELECT COUNT(*) AS like_count FROM Likes WHERE RepID = ?", [$repID]);
    $row = $result->fetch();
    $like_count = $row['like_count'];

    // ユーザーのいいね状態の確認（ここではユーザーIDを 'kd1@gmail.com' と仮定）
    $user_id = 'kd1@gmail.com'; // 実際のアプリではセッションなどから取得
    $user_like_result = $db->query("SELECT 1 FROM Likes WHERE UsID = ? AND RepID = ?", [$user_id, $repID]);
    $user_liked = $user_like_result->rowCount() > 0;
    ?>
    <div class="like-container">
        <button id="likeButton" class="like-button <?php if ($user_liked) echo 'liked'; ?>">❤️</button>
        <span id="likeCount"><?php echo $like_count; ?></span>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const likeButton = document.getElementById("likeButton");
            const likeCount = document.getElementById("likeCount");
            let liked = <?php echo $user_liked ? 'true' : 'false'; ?>;
            const userId = "<?php echo $user_id; ?>";
            const repID = <?php echo $repID; ?>;

            likeButton.addEventListener("click", () => {
                liked = !liked;
                likeButton.classList.toggle("liked", liked);
                likeCount.textContent = parseInt(likeCount.textContent) + (liked ? 1 : -1);

                // サーバーにいいねの状態を送信
                fetch('like_update.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId,
                        repID,
                        liked
                    }),
                });
            });
        });
    </script>
</body>

</html>