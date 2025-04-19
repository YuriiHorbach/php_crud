<?php
include 'partials/header.php';

require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
  include 'partials/not_found.php';
  exit;
}

$userId = $_GET['id'];

$user = getUserById($userId);

if (!$user) {
  include 'partials/not_found.php';
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  updateUser($_POST, $userId);
  $user = getUserById($userId);
  if (isset($_FILES['picture'])) {
    updloadImage($_FILES['picture'], $user);
  }
  header("Location: index.php");
}

include '_form.php';
include 'partials/footer.php';

// echo "<per>";
// var_dump($_FILES);
// echo "</per>";
// exit;
