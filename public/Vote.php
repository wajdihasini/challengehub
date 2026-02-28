<?php

session_start();

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/controllers/VoteController.php';

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Check if submission is selected
if (!isset($_POST['id_sub']) || empty($_POST['id_sub'])) {
    die("Error: No submission selected.");
}

$database = Database::getInstance();
$db = $database->getConnection();

$controller = new VoteController($db);

$user_id = $_SESSION['id_user'];   // from users table
$submission_id = $_POST['id_sub']; // from submissions table

$controller->vote($user_id, $submission_id);

header("Location: submissions.php");
exit;