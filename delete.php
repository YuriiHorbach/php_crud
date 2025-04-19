<?php
include 'partials/header.php';

require __DIR__ . '/users/users.php';

if (!isset($_POST['id'])) {
  include 'partials/not_found.php';
  exit;
}

// $userId = $_GET['id'];
var_dump($_POST['id']);
$userId = $_POST['id'];

$user = getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($userId) && !empty($userId)) {
    deleteUser($userId);
  }
  header("Location: index.php");
  exit;
}

if (!$user) {
  include 'partials/not_found.php';
  exit;
}
