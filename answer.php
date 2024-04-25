<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>回答入力</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 20px;
        }

        form {
            width: 80%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        textarea,
        input[type="button"] {
            resize: none;
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        input[type="button"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-right: 0;
        }

        br {
            clear: both;
        }

        a {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>回答入力</h1>
    <form>
        <h2>質問内容:</h2>
    </form>
    <form id="answerForm">
        <textarea id="answer" name="answer" rows="4" cols="50"></textarea><br><br>
        <input type="button" value="投稿" onclick="postAnswer()">
    </form>
    <br>
    <a href="index.php">ホーム</a>
</body>

</html>