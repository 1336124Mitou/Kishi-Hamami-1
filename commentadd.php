<?php
// 必要なPOSTデータが受け取られたかどうかを確認します。
if(isset($_POST['Com']) && isset($_POST['RepoID'])) {
    // 投稿されたコメントと記事のIDを取得する
    $commentText = $_POST['Com'];
    $reportID = $_POST['RepoID'];

    // Comentクラスを追加し、オブジェクトを起動します。
    require_once __DIR__ . '/comment.php';
    $comment = new Comment();

    // コメントをデータベースに追加します。
    $comment->addCom($commentText, $reportID);

    // もし必要であれば、$kijiIDに$reportIDを設定する。
    $kijiID = $reportID;

    // 記事詳細ページに戻るようにします
    require_once __DIR__ . '/ndet.php';
} else {
    // もし必要なPOSTデータが受け取られない場合はこの対応になります。
    echo "Error: Required POST data is missing.";
}
?>
