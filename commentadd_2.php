<?php
// 投稿された記事コメントのIDを受け取る
$Com = $_POST['Com'];
$RDet = $_POST['RDet'];
//$UsID = $_POST['userID'];

require_once __DIR__ . '/comment_2.php';

$comment = new Comment();
session_start();
$comment->addCom($Com, $RDet);

require_once __DIR__ . '/ndet_2.php';
