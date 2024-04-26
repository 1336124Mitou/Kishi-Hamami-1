<?php
    // 投稿された質問のIDを受け取る
    $Det = $_POST['QDet'];

    require_once __DIR__.'shitsumon.php';
    $Quest =  new Quest();
    session_start();
    $Quest->addQuestion($Det, $_SESSION['UsID']);

    require_once __DIR__.'Allquestion.php';