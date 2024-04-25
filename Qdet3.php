<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>質問詳細</title>
    <link rel="stylesheet" href="main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        main {
            padding: 20px;
        }

        footer {
            background-color: #f4f4f4;
            padding: 10px 20px;
            text-align: center;
        }

        /* ボタンの微調整 */
        input.button {
            border: 1px solid;
            width: 100px;
            height: 35px;
            font-size: 15px;
            align-self: center;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background-color: #007BFF;
        }

        p.tag {
            border: 1px solid;
            display: inline-block;
            border-radius: 20px;
            background-color: #ccc;
        }

        .frame {
            padding: 10px;
            width: 450px;
            margin-bottom: 10px;
            border: 1px solid #333333;
            border-radius: 10px;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const num1 = document.getElementById('num1');
            const button1 = document.getElementById('bt1');
            const num2 = document.getElementById('num2');
            const button2 = document.getElementById('bt2');

            let count1 = 0;
            let count2 = 0;

            button1.addEventListener('click', function () {
                count1++;
                num1.innerHTML = count1;
            });

            button2.addEventListener('click', function () {
                count2++;
                num2.innerHTML = count2;
            });
        });
    </script>
</head>

<body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>
        <nav>
            <ul class="nav">
                <li><a href="index.html" class="btn4">ホーム</a></li>
                <li><a href="Allquestion.html" class="btn2">質問一覧</a></li>
                <li><a href="Allproject.html" class="btn4">制作物一覧</a></li>
                <li><a href="profile.html" class="btn4">プロフィール</a></li>
                <li><a href="login.html" class="btn4">ログイン</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="frame">
            <h2>C言語についての質問</h2>
            <hr>

            <p>AIの活用方法を探しています。このような性能をしたAIはありませんか？無料だと嬉しいです。</p>

            <p class="tag">#AI</p><br>
        </div>
    </main>

    <main>

        <div class="frame">
            <h2>回答</h2>

            <p>こういう風に活用するのが良いのでは</p>
            <p id="num1">0</p><button id="bt1">いいね</button>

            <hr>

            <p>有料ですがこういうのがあります</p>
            <p id="num2">0</p><button id="bt2">いいね</button>

            <hr>
            <form method="post" action="answer.html">
                <input class="button" type="submit" value="回答追加">
            </form>
        </div>

    </main>

    <footer>
        <p></p>
    </footer>
</body>

</html>