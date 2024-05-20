<!DOCTYPE html>
<html lang="ja">

<head>
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

        .profile-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            text-align: center;
            padding: 20px;
            margin: 40px auto;
            position: relative;
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
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

        .form-group {
            margin: 15px 0;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 10px;
        }

        .form-group textarea {
            height: 100px;
            resize: none;
        }

        .save-button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 20px;
        }

        .save-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/header.php'; ?>

    <div class="profile-container">
        <h2>プロフィール更新</h2>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile-img">プロフィール画像</label>
                <input type="file" id="profile-img" name="profile-img">
            </div>
            <div class="form-group">
                <label for="name">名前</label>
                <!--名前をSQLに更新できるように修正予定-->
                <input type="text" id="name" name="name" value="岸本 昂己" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <!--メールアドレスをSQLに更新できるように修正予定-->
                <input type="email" id="email" name="email" value="kd1347722@st.kobedenshi.ac.jp" required>
            </div>
            <div class="form-group">
                <label for="bio">自己紹介</label>
                <!--自己紹介をSQLに更新できるように修正予定-->
                <textarea id="bio" name="bio">なんでも頑張ります！</textarea>
            </div>
            <button type="submit" class="save-button">保存</button>
        </form>
    </div>

</body>

</html>
