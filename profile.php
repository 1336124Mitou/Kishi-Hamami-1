<!DOCTYPE html>
<html lang="ja">
<?php
if (!isset($user)) { //user変数が無ければ
    require_once __DIR__ . '/user.php';
    $user = new User();
}
?>

<head>
    <?php require_once __DIR__ . '/header.php';
    //プロフィール情報を抽出
    $profile = $user->myProfile($_SESSION['userId']);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <title>ログイン</title>
    <link href="main.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0
        }

        .profile-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            text-align: center;
            padding: 20px;
            margin-left: 120px;
            position: relative;
        }

        .profile-header {
            display: flex;
            align-items: center;
            text-align: left;
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
    </style>
</head>

<body>


    <div class="profile-container">
        <button class="edit-profile-button">プロフィールを編集</button>
        <div class="profile-header">
            <img src="1676155437876-5NNUYKTjTE.png" alt="プロフィール画像" class="profile-img">
            <div>
                <div class="profile-name"><?= $_SESSION['userName'] ?></div>
                <div class="profile-emailaddress"><?= $_SESSION['userId'] ?></div>
            </div>
        </div>
        <div class="profile-stats">
            <div class="profile-stat">
                <label>プロフィール</label>
                <hr>
            </div>
        </div>
        <div class="profile-bio"><?= $profile['Prof'] ?></div>
    </div>

</body>

</html>