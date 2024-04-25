<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>プログラミング情報共有サイト（仮）</title>
    <link href="main.css" rel="stylesheet">
    <script src="index.js" defer></script>
</head>
<style>
    a.que {
        float: right;
        border-radius: 5px;
        background-color: #007BFF;
        padding: 10px;
        text-decoration: none;
        color: white;
    }

    a[href="#kiji1"],
    a[href="#kiji2"],
    a[href="#kiji3"] {
        color: blue;
        width: 500px;
        margin-top: 0;
        font-weight: bold;
    }

    h2 {
        font-weight: bold;
        line-height: 2;
        color: #000000;
        margin: 25px 0;
    }

    p {
        font-weight: bold;
        line-height: 2;
        color: #333;
    }

    th,
    td {
        border: solid 1px;
        /* 枠線指定 */
        padding: 10px;
        /* 余白指定 */
    }

    table {
        margin-left: 5px;
        color: black
    }

    .frame-article {
        padding: 10px;
        width: 450px;
        margin-bottom: 10px;
        border: 1px solid #333333;
        border-radius: 10px;
    }

    .frame-tag {
        padding: 1px;
        width: 80px;
        margin-bottom: 1px;
        border: 1px solid #333333;
    }

    button {
        background-color: #fff;
        border-color: #fff;
    }

    p.tag {
        border: 1px solid;
        display: inline-block;
        border-radius: 20px;
        background-color: #ccc;
    }

    #a1 {
        color: #007BFF;
    }
</style>

<body>
    <header>
        <h1>プログラミング情報共有サイト（仮）</h1>

        <nav>
            <ul class="nav">
                <!--ヘッダー ここから-->
                <li><a href="index.html" class="btn2">ホーム</a></li>
                <li><a href="Allquestion.html" class="btn4">質問一覧</a></li>
                <li><a href="Allproject.html" class="btn4">制作物一覧</a></li>
                <li><a href="profile.html" class="btn4">プロフィール</a></li>
                <li><a href="login.html" class="btn4">ログイン</a></li>
                <!--ヘッダー 追加はここから-->
            </ul>
        </nav>

    </header>

    <div class="main">
        <div class="main_con">
            <h2>記事一覧</h2>
            <p><a href="#kiji1">プログラミング言語関連記事</a><br>
                <a href="#kiji2">データベース関連記事</a><br>
                <a href="#kiji3">AI関連記事</a><br>
                <hr>
            </p>
            <!-- 絞り込み機能追加 -->
            <input type="text" id="filterInput" oninput="filterArticles(this.value)" placeholder="絞り込み"
                style="width: 300px;height: 40px;">
            <br>
            <p>並べ替え</p>
            <!--並べ替え機能 ここから-->
            <button onclick="sortArticles('tags')">タグで並べ替え</button>
            <button onclick="sortArticlesByTitle()">タイトルで並べ替え</button>
            <button onclick="sortArticles('day')">日付で並べ替え</button>
            <!--並べ替え機能 ここまで-->
            <hr>
            <div class="articles">
                <!--記事一覧 ここから-->
                <div id="kiji1" class="article" data-tags="Java">
                    <h2>プログラミング言語関連</h2>
                    <div class="frame-article">
                        <p><a id="a1" href="ndet.html">テンプレート1</a><br><a id="a1" href="ndet.html">テンプレート2</a></p>
                    </div>
                    <p class="tag">#プログラミング言語</p><br>
                </div>
                <div id="kiji2" class="article" data-tags="SQL">
                    <h2>データベース関連</h2>
                    <div class="frame-article">
                        <p><a id="a1" href="ndet.html">テンプレート1</a><br><a id="a1" href="ndet.html">テンプレート2</a></p>
                    </div>
                    <p class="tag">#データベース</p><br>
                </div>

                <div id="kiji3" class="article" data-tags="chatGPT">
                    <h2>AI関連</h2>
                    <div class="frame-article">
                        <p><a id="a1" href="ndet.html">テンプレート1</a><br><a id="a1" href="ndet.html">テンプレート2</a></p>
                    </div>
                    <p class="tag">#AI</p><br>
                    <!--記事 追加はここから-->
                </div>
            </div>
        </div>
    </div>

</body>

</html>