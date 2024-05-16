<?php
session_start();
//全てのセッション変数を削除
$_SESSION = array();

//セッションに登録されたデータを全て破棄
session_destroy();

header('Location:login.php');
