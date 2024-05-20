<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/user2.php';
$user = new User();

// プロフィール情報を抽出
$profile = $user->myProfile($_SESSION['userId']);

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $prof = $_POST['prof'];

    // 入力検証
    if (empty($userName) || empty($prof)) {
        $error = 'すべてのフィールドを入力してください。';
    } else {
        // プロフィール更新
        if ($user->updateProfile($_SESSION['userId'], $userName, $prof)) {
            $success = 'プロフィールが更新されました。';
            // 最新のプロフィール情報を取得
            $profile = $user->myProfile($_SESSION['userId']);
        } else {
            $error = 'プロフィールの更新に失敗しました。';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <?php require_once __DIR__ . '/header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール更新</title>
    <link href="main.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .update-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            text-align: center;
            padding: 20px;
            margin: 50px auto;
            position: relative;
        }

        .update-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group .error {
            color: red;
            font-size: 12px;
        }

        .form-group .success {
            color: green;
            font-size: 12px;
        }

        .update-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
        }

        .update-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="update-container">
        <div class="update-header">プロフィール更新</div>
        <?php if ($error): ?>
            <div class="form-group error"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="form-group success"><?= $success ?></div>
        <?php endif; ?>
        <form action="update_profile.php" method="POST">
            <div class="form-group">
                <label for="userName">ユーザー名</label>
                <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($profile['UsName'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <div class="form-group">
                <label for="prof">プロフィール</label>
                <textarea id="prof" name="prof" required><?= htmlspecialchars($profile['Prof'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <button type="submit" class="update-button">更新</button>
        </form>
    </div>
</body>
</html>

