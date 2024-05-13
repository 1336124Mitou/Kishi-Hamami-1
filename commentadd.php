<?php
// 投稿された記事コメントのIDを受け取る
$kiji = $_POST['Com'];
$Repo = $_POST['RepoID'];

require_once __DIR__ . '/comment.php';

$comment = new Comment();
session_start();
$comment->addCom($kiji, $Repo);
//受け取った$Ouestを$question_idとして定義する
$report_id = $Repo;
require_once __DIR__ . '/ndet.php';
