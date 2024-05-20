<?php
$UName = $_POST['name'];
$Mail = $_POST['email'];
$Pass = $_POST['password'];
$Past = $_POST['check'];
$ProfPic = $_POST['imageFile'];
$Info = $_POST['info'];

require_once __DIR__ . '/user.php';

$NUser = new User();
session_start();
$result = $NUser->NewUser($Mail, $UName, $Pass, $Past, $Info, $ProfPic);

if ($result == 1) {
    header('Location:NAccount.php?message=email_exists');
    // echo "<script>alert('このメールは既に登録されています。');</script>";
} elseif ($result == 2) {
    header('Location:NAccount.php?message=wrong_password');
    // echo "<script>alert('パスワードの入力が間違っています。');</script>";
} else {
    $login = $NUser->logincheck($Mail, $Pass);

    $_SESSION['userId'] = $login['UsID'];
    $_SESSION['userName'] = $login['UsName'];
    header('Location:index.php');
    exit();
}