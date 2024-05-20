<?php
// 送られてきたユーザーIDを受け取る
$userId = $_POST['userId'];
// 送られてきた変更前のパスワードを受け取る
$curPass = $_POST['current_password'];
// 送られてきた変更後のパスワードを受け取る
$newPass = $_POST['new_password'];
// 送られてきた変更後の（確認用）パスワードを受け取る
$conPass = $_POST['confirm_password'];


require_once __DIR__ . '/user.php';
$user = new User();
$result = $user->logincheck($userId, $curPass);
//現在のパスワードが違う場合、エラーメッセージを保存し、パスワード変更画面に遷移する
if (empty($result['UsID'])) { //userIdが格納されていないなら
    $error = '現在のパスワードが正しくありません';
}
//新しいパスワードと確認用のパスワードが一致しない場合、エラーメッセージを保存し、パスワード変更画面に遷移する
elseif ($newPass != $conPass) {
    $error = '新しいパスワードと確認用のパスワードが一致しません';
} // パスワード変更処理を行う
else {
    $result = $user->passchange($userId, $newPass);
    if ($result['Passw'] ==  $newPass) {
        $mess = '';
    } else {
        $error = 'パスワードの変更に失敗しました';
    }
}

// 成功メッセージを表示する
include_once __DIR__ . '/passchan.php';

if (isset($mess)) {
    echo "<script>alert('パスワードの変更に成功しました');</script>";
}
?>
