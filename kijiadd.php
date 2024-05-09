<?php
// 投稿された記事のIDを受けとる
$Det = $_POST['RDet'];
$UsID = $_POST['userID'];

require_once __DIR__ . '/kiji.php';
$Report = new Report();
session_start();
$Report->addReport($RDet, $UsID);

require_once __DIR__ . '/index.php';
