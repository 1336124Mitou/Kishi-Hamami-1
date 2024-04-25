//キーワード検査
function filterArticles(keyword) {
    var articles = document.querySelectorAll('.article');
    articles.forEach(function (article) {
        var tags = article.getAttribute('data-tags');
        var title = article.querySelector('h2').innerText.toLowerCase();
        if (tags.includes(keyword) || title.includes(keyword.toLowerCase())) {
            article.style.display = 'block';
        } else {
            article.style.display = 'none';
        }
    });
}
function sortArticles(key) {
    var articlesContainer = document.querySelector('.articles');
    var articles = Array.from(articlesContainer.children);
    articles.sort(function (a, b) {
        var aVal = a.getAttribute('data-' + key);
        var bVal = b.getAttribute('data-' + key);
        // 日付を比較するために、文字列からDateオブジェクトに変換する
        var dateA = new Date(aVal);
        var dateB = new Date(bVal);
        // 日付を比較
        return dateA - dateB;
    });
    articles.forEach(function (article) {
        articlesContainer.appendChild(article);
    });
}
//タイトル絞り込み
function sortArticlesByTitle() {
    var articlesContainer = document.querySelector('.articles');
    var articles = Array.from(articlesContainer.querySelectorAll('.article'));

    articles.sort(function (a, b) {
        var titleA = a.querySelector('h2').textContent.toLowerCase();
        var titleB = b.querySelector('h2').textContent.toLowerCase();
        return titleA.localeCompare(titleB);
    });

    articles.forEach(function (article) {
        articlesContainer.appendChild(article);
    });
}

