<?php
// 投稿された記事のIDを受けとる
$Title = $_POST['Title'];
$RDet = $_POST['RDet'];
// ↓↓今は使用しない
// $UsID = $_POST['userID'];

require_once __DIR__ . '/kiji.php';
$Report = new Report();
session_start();
$Report->addReport($RDet, $Title);

require_once __DIR__ . '/index.php';
