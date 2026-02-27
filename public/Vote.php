<?php

session_start();

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/controllers/VoteController.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if submission_id is provided
if (!isset($_POST['submission_id']) || empty($_POST['submission_id'])) {
    die("Error: No submission selected.");
}

$database = Database::getInstance();
$db = $database->getConnection();

$controller = new VoteController($db);

$user_id = $_SESSION['user_id'];
$submission_id = $_POST['submission_id'];

$controller->vote($user_id, $submission_id);

header("Location: submissions.php");
exit;