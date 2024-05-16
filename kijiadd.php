<?php
// 投稿された記事のIDを受けとる
$Title = $_POST['Title'];
$RDet = $_POST['RDet'];
$RTag = $_POST['RTag'];
$UsID = $_POST['userID'];

require_once __DIR__ . '/kiji.php';
require_once __DIR__ . '/tags.php';
require_once __DIR__ . '/user.php';
$Report = new Report();
$Tag = new Tag();
$User = new UR();
session_start();
$RID = $Report->addReport($RDet, $Title);
$Tag->addTagR($RID, $RTag);
$User->insertURlink($UsID, $RID);

header("Location:index.php");
exit();
