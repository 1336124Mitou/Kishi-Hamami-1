<?php
// 投稿されたコメントのIDを受け取る
$Kai = $_POST['Com'];
$Quest = $_POST['QuestionID'];
// $UsID = $_POST['userID'];

require_once __DIR__ . '/kaitou.php';

$kaitou = new Comment();
session_start();
$kaitou->addCom($Kai, $Quest);
//受け取った$Ouestを$question_idとして定義する
$question_id = $Quest;
require_once __DIR__ . '/answer.php';
