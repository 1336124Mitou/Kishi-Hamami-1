<?php
$QId = $_POST['QID'];
require_once __DIR__ . '/shitsumon.php';

$question = new Quest();

$question->deleteQuestion($QId);

header("Location:Allquestion.php");
exit();
