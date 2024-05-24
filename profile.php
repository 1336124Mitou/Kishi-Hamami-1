<?php
session_start();
if (!isset($user)) {
    require_once __DIR__ . '/user.php';
    $user = new User();
}

if (isset($_POST["usid"])) {
    $usid = $_POST["usid"];
    $profile = $user->myProfile($usid);
} else {
    $usid = $_SESSION['userId'];
    $profile = $user->myProfile($usid);
}


// ユーザーが投稿した質問を取得
$questions = $user->getUserQuestions($usid);

// ユーザーが投稿した記事を取得
$reports = $user->getUserReports($usid);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require_once __DIR__ . '/header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
    <link href="main.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 700px;
            text-align: center;
            padding: 20px;
            margin: 20px auto;
            position: relative;
        }

        .profile-header {
            display: flex;
            align-items: center;
            text-align: left;
            flex-wrap: wrap;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .profile-details {
            text-align: left;
            flex-grow: 1;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
        }

        .profile-emailaddress {
            font-size: 14px;
            color: #777;
        }

        .profile-bio {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }

        .profile-stats {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            margin: 20px 0;
        }

        .profile-stat {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
        }

        .profile-stat label {
            font-size: 12px;
            color: #777;
            margin-left: 100px;
        }

        .profile-stat hr {
            flex-grow: 1;
            border: none;
            border-top: 1px solid #ddd;
        }

        .edit-profile-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .edit-profile-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
            }

            .profile-img {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .profile-details {
                text-align: center;
            }

            .edit-profile-button {
                top: 10px;
                right: 10px;
            }
        }

        .post-container {
            margin-top: 20px;
        }

        .post {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .post h3 {
            margin-top: 0;
        }

        .post a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .post a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function redirectToUpdateProfile() {
            window.location.href = 'update_profile.php';
        }
    </script>
</head>

<body>
    <div class="profile-container">
        <?php
            if ($_SESSION['userId'] == $profile['UsID']) {
        ?>
            <button class="edit-profile-button" onclick="redirectToUpdateProfile()">プロフィールを編集</button>
        <?php
            }
        ?>
        <div class="profile-header">
            <img src="1676155437876-5NNUYKTjTE.png" alt="プロフィール画像" class="profile-img">
            <div class="profile-details">
                <div class="profile-name"><?= htmlspecialchars($profile['UsName'], ENT_QUOTES, 'UTF-8') ?></div>
                <div class="profile-emailaddress"><?= htmlspecialchars($profile['UsID'], ENT_QUOTES, 'UTF-8') ?></div>
            </div>
        </div>
        <div class="profile-stats">
            <div class="profile-stat">
                <label>プロフィール</label>
                <hr>
            </div>
        </div>
        <div class="profile-bio"><?= htmlspecialchars($profile['Prof'], ENT_QUOTES, 'UTF-8') ?></div>

        <!-- 質問の表示 -->
        <div class="post-container">
            <h2>投稿した質問</h2>
            <?php foreach ($questions as $question) : ?>
                <div class="post">
                    <?php if (isset($question['Question'])) : ?>
                        <h3><?= htmlspecialchars($question['Question'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <?php endif; ?>
                    <a href="answer.php?question_id=<?= isset($question['QuestionID']) ? htmlspecialchars($question['QuestionID'], ENT_QUOTES, 'UTF-8') : '' ?>">詳細</a> <!-- 詳細ボタン -->
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 記事の表示 -->
        <div class="post-container">
            <h2>投稿した記事</h2>
            <?php foreach ($reports as $report) : ?>
                <div class="post">
                    <?php if (isset($report['Report'])) : ?>
                        <h3><?= htmlspecialchars($report['Report'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <?php endif; ?>
                    <a href="ndet.php?kijiID=<?= isset($report['RepoID']) ? htmlspecialchars($report['RepoID'], ENT_QUOTES, 'UTF-8') : '' ?>">詳細</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>