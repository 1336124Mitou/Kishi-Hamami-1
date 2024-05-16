<?php
// 投稿された質問の内容を受け取る
$Det = $_POST['QDet'];
$UsID = $_POST['userid'];
// タグのIDを受け取る
$Qtag = $_POST['Qtag'];
$UsID = $_POST['userID'];


require_once __DIR__ . '/shitsumon.php';
require_once __DIR__ . '/tags.php';
require_once __DIR__ . '/user.php';
$Quest =  new Quest();
$Tag = new Tag();
$User = new UQ();
session_start();
//質問の内容を登録してIDを取得
$QId = $Quest->addQuestion($Det, $UsID);
$Tag->addTagQ($QId, $Qtag);
$User->insertUQlink($UsID, $QId);

require_once __DIR__ . '/Allquestion.php';
