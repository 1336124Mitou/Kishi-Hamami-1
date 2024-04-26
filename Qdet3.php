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






.checkbox {
    display: none;
}

/* ポップアップwindow部分 */
#overlay {
    visibility: hidden;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 70;
    width: 100%;
    height: 100%;
}
/* オーバーレイの背景部分 */
#bg_gray {
    background: rgba(0,0,0,0.5);
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 80;
}
/* ウィンドウ部分 */
#window {
    width: 50%;
    padding: 20px;
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 20px -6px rgba(0,0,0,0.6);
    z-index: 90;
    opacity: 0;
}
/* 閉じるボタン */
#btn_cloth {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #007BFF;
    border-radius: 5px;
    z-index: 100;
    cursor: pointer;
}
#btn_cloth:hover {
    opacity: 0.7;
}
#btn_cloth span,
#btn_cloth span::before {
    display: block;
    height: 3px;
    width: 25px;
    border-radius: 3px;
    background: #fff;
}
#btn_cloth span {
    transform: rotate(45deg);
}
#btn_cloth span::before {
    content: "";
    position: absolute;
    bottom: 0;
    transform: rotate(-90deg);
}


/* クリックでオーバーレイ表示 */
#popup:checked ~ #overlay {
    visibility: visible;
}
#popup:checked ~ #overlay #window {
    animation: fadein 500ms forwards;
    animation-timing-function: ease-in-out;
}
@keyframes fadein {
    100% {
        opacity: 1;
    }
}

/* オーバーレイのスタイル */
#msg a {
    
    display: inline-block;
    color: #fff;
    background: #007BFF;
    border-radius: 20px;
    padding: 0.5em 1.5em;
}
#msg a:hover {
    opacity: 0.7;
}
#msg h2 {
    text-align: center;
}
textarea {
    text-align: center;
}
</style>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const num1 = document.getElementById('num1');
            const button1 = document.getElementById('bt1');
            const num2 = document.getElementById('num2');
            const button2 = document.getElementById('bt2');

            let count1 = 0;
            let count2 = 0;

            button1.addEventListener('click', function() {
                count1++;
                num1.innerHTML = count1;
            });

            button2.addEventListener('click', function() {
                count2++;
                num2.innerHTML = count2;
            });
        });

        function check( id ) {
            document.getElementById( id ).checked = true;
        }
    </script>
</head>

<body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>
        <nav>
            <ul class="nav">
                <li><a href="index.php" class="btn4">ホーム</a></li>
                <li><a href="Allquestion.php" class="btn2">質問一覧</a></li>
                <li><a href="Allproject.php" class="btn4">制作物一覧</a></li>
                <li><a href="profile.php" class="btn4">プロフィール</a></li>
                <li><a href="login.php" class="btn4">ログイン</a></li>
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
            
            <!-- クリック動作判定 -->
            <input class="checkbox" type="checkbox" id="popup">

            <!-- ポップアップ部分 -->
            <div id="overlay">
                <label for="popup" id="bg_gray"></label> <!-- ウィンドウの外のグレーの領域 -->

                <div id="window"> <!-- ウィンドウ部分 -->
                    <label for="popup" id="btn_cloth"> <!-- 閉じるボタン -->
                        <span></span>
                    </label>
                    <div id="msg"> <!-- ウィンドウのコンテンツ -->
                        <h2>回答投稿</h2>
                        <textarea id="answer" name="answer" rows="5" cols="70"></textarea><br><br>
                        <a href="">投稿</a>
                    </div>
                </div>

            </div>

            <input class="button" onclick="check('popup');" type="button" value="回答追加">
        </div>

    </main>

    <footer>
        <p></p>
    </footer>
</body>

</html>