<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ReplyID = isset($_POST['ReplyID']) ? $_POST['ReplyID'] : null;
$UID = isset($_POST['UserID']) ? $_POST['UserID'] : null;

if ($ReplyID === null || $UID === null) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing parameters.']);
    exit;
}

require_once __DIR__ . '/likeR.php';
session_start();
$LReply = new LikeRepo();

try {
    $LReply->addLikeR($ReplyID, $UID);
    $like = $LReply->showLikeR($ReplyID);
    echo json_encode(['success' => true, 'newLikeCount' => $like['LNum']]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'An error occurred.']);
}
?>
