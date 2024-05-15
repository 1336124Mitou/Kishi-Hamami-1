<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <title>ログイン</title>
    <link href="main.css" rel="stylesheet">
    <style>
        .profile-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
            padding: 20px;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .profile-username {
            font-size: 18px;
            color: #777;
            margin: 5px 0;
        }
        .profile-bio {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }
        .profile-stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .profile-stat {
            text-align: center;
        }
        .profile-stat span {
            display: block;
            font-size: 18px;
            font-weight: bold;
        }
        .profile-stat label {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <div class="profile-container">
        <img src="profile-image.jpg" alt="プロフィール画像" class="profile-img">
        <div class="profile-name">山田 太郎</div>
        <div class="profile-username">@yamada_taro</div>
        <div class="profile-bio">こんにちは！Web開発者で、趣味は読書と旅行です。</div>
        <div class="profile-stats">
            <div class="profile-stat">
                <span>150</span>
                <label>投稿</label>
            </div>
            <div class="profile-stat">
                <span>300</span>
                <label>フォロワー</label>
            </div>
            <div class="profile-stat">
                <span>180</span>
                <label>フォロー中</label>
            </div>
        </div>
    </div>

</body>

</html>
    