<?php
$ReplyID = $_POST['ReplyID'];

require_once __DIR__ . '/likeR.php';
$LReply = new LikeRepo();
session_start();
$LReply->addLikeR($ReplyID);
$kijiID = $ReplyID;
require_once __DIR__ . '/ndet.php';
