<?php
// 投稿された記事のIDを受けとる
$Title = $_POST['Title'];
$RDet = $_POST['RDet'];
$RTag = $_POST['RTag'];
// ↓↓今は使用しない
// $UsID = $_POST['userID'];

require_once __DIR__ . '/kiji.php';
require_once __DIR__ . '/tags.php';
$Report = new Report();
$Tag = new Tag();
session_start();
$RID = $Report->addReport($RDet, $Title);
$Tag->addTagR($RID, $RTag);

header("Location:index.php");
exit();
