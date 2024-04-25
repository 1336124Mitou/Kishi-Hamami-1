<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>質問詳細</title>
    
    <link rel="stylesheet" href="Qdet.css">

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

            <p>C言語のポインタがさっぱり分かりません。<br>
                あとスコープも分かりません。<br>
                古い言語なのでいろいろ不便です。<br>
                どうすればいいですか？</p>

            <p class="tag">#プログラミング言語</p>
            <p class="tag">#C言語</p><br>
        </div>
    </main>

    <main>

        <div class="frame">
            <h2>回答</h2>

            <p>Cは最初だけ触れたらゆっくりでいいですよ。</p>
            <p id="num1">0</p><button id="bt1">いいね</button>

            <hr>

            <p>こういう風にすると理解しやすいですよ。</p>
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