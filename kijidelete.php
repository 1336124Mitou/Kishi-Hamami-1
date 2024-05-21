<?php
$RepoId = $_POST['kijiID'];
require_once __DIR__ . '/kiji.php';

$kiji = new Report();

$kiji->deleteReport($RepoId);

header("Location:index.php");
exit();
