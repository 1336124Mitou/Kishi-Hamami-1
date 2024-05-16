<?php
// 送られてきたメールアドレスとパスワードを受け取る
$userId = $_POST['email'];
$password = $_POST['password'];

require_once __DIR__ . '/user.php';
$user = new User();
$result = $user->logincheck($userId, $password);

session_start();
//ログインに失敗した場合、エラーメッセージをセッションに保存し、ログイン画面に遷移する
if (empty($result['UsID'])) { //userIdが格納されていないなら
    $_SESSION['login_error'] = 'メールアドレス、パスワードを確認してください。';
    header('Location:login.php');
    exit();
} else {
    //ログインに成功したならセッションにユーザー情報を保存し、記事一覧画面に遷移する
    // ユーザー情報をセッションに保持する
    $_SESSION['userId'] = $result['UsID']; //ユーザーIDのセッション
    $_SESSION['userName'] = $result['UsName']; //ユーザーネームのセッション
    header('Location:index.php');
    exit();
}
