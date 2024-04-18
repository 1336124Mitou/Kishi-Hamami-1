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


