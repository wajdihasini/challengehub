<?php

session_start();

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/controllers/VoteController.php';

// Check if user is logged in (support both common session variable names)
$sessionUserId = $_SESSION['id_user'] ?? $_SESSION['user_id'] ?? null;

if ($sessionUserId === null) {
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

$user_id = $sessionUserId;
$submission_id = (int)$_POST['id_sub'];

$controller->vote($user_id, $submission_id);

// Redirect back to the referring page or index
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: " . $redirect);
exit;
