<?php
// 投稿された質問の内容を受け取る
$Det = $_POST['QDet'];
$UsID = $_POST['userid'];
// タグのIDを受け取る
$Qtag = $_POST['Qtag'];


require_once __DIR__ . '/shitsumon.php';
require_once __DIR__ . '/tags.php';
$Quest =  new Quest();
$Tag = new Tag();
session_start();
$QId = $Quest->addQuestion($Det, $UsID);
$Tag->addTagQ($QId, $Qtag);

require_once __DIR__ . '/Allquestion.php';
