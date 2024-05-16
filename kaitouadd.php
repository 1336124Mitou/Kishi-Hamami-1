<?php
// 投稿されたコメントのIDを受け取る
$Kai = $_POST['Com'];
$Quest = $_POST['QuestionID'];
$UsID = $_POST['userID'];

require_once __DIR__ . '/kaitou.php';
require_once __DIR__ . '/user.php';

$kaitou = new Comment();
$User = new URe();
session_start();
$kaitou->addCom($Kai, $Quest);
//受け取った$Ouestを$question_idとして定義する
$question_id = $Quest;
$User->insertURelink($UsID, $question_id);
require_once __DIR__ . '/answer.php';
