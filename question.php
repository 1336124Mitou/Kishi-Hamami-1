<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 20px;
        }

        /* テキストボックスの微調整 */
        textarea {
            border: 1px solid #ccc;
            padding: 10px;
            width: 700px;
            height: 100px;
            font-size: 25px;
            color: rgba(0, 0, 0, 0.3);
            /* Initial text color */
            resize: none;
        }

        /* ボタンの微調整 */
        input[type="button"] {
            border: 1px solid;
            width: 700px;
            height: 50px;
            font-size: 20px;
            align-self: center;
            color: white;
            background-color: #007BFF;
        }

        form {
            border: 5px solid #ccc;
            width: 750px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        a {
            margin-left: auto;
            border: 1px #007BFF;
        }

        select {
            margin: 10px;
        }
    </style>
</head>

<body>
    <!-- ページのタイトル -->
    <h1>質問入力</h1>

    <form>
        <!-- テキストボックス -->
        <textarea id="quest" placeholder="ここに質問を書いてください。" oninput="changeTextColor(this)"></textarea>

        <!-- タグ -->
        <select name="tag">
            <option value="タグ1">プログラミング言語</option>
            <option value="タグ2">データベース</option>
            <option value="タグ3">その他</option>
        </select>

        <!-- ボタン -->
        <input type="button" value="投稿" onclick="PostQuest()"></input>
    </form>

    <script>
        // テキストボックス文字色を変えるfunction
        function changeTextColor(textbox) {
            if (textbox.value.trim() !== "") {
                textbox.style.color = "rgba(0, 0, 0, 1)"; // Darker text color
            } else {
                textbox.style.color = "rgba(0, 0, 0, 0.3)"; // Initial text color
            }
        }

        // テキストボックスの内容を送信する
        function PostQuest() {
            const q = document.getElementById('quest').value;

            console.log("Q:", q);

            document.getElementById('quest').reset();
        }
    </script>

    <!-- ホーム画面に戻る -->
    <a href="index.php">ホーム画面に戻る</a>

</body>

</html>