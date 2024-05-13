<style>
    footer {
        height: 80px;
        background: #000000;
    }

    .top {
        font-size: 20px;
        color: #ffffff;
        text-decoration: none;
        margin: 0;
        position: relative;
    }

    .top::after {
        position: absolute;
        left: 0;
        /* コンテンツが空でも疑似要素を表示する為に必要 */
        content: '';
        /* アンダーラインを親要素の幅に合わせる */
        width: 100%;
        /* アンダーラインの太さ */
        height: 2px;
        background: #3367ff;
        /* アンダーラインが位置する、親要素の下端からの高さ */
        bottom: -2px;
        /* 変形のコード */
        transform: scale(0, 1);
        transform-origin: right top;
        transition: transform 0.4s;
    }

    .top:hover::after {
        /* ホバー時の動作 */
        transform: scale(1, 1);
        transform-origin: left top;
    }
</style>
<footer>
    <a href="#" class="top">ページ上に戻る</a>
</footer>