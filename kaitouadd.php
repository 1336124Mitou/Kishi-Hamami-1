<?php
// 投稿されたコメントのIDを受け取る
$Kai = $_POST['Com'];
$Quest = $_POST['QuestionID'];

require_once __DIR__ . '/kaitou.php';
require_once __DIR__ . '/Allquestion.php';
$kaitou = new Comment();
session_start();
$kaitou->addCom($Kai, $Quest);
return $Quest;
