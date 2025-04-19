<?php
include 'partials/header.php';

require __DIR__ . '/users/users.php';

$user = [
  'id' => '',
  'name' => '',
  'username' => '',
  'email' => '',
  'phone' => '',
  'website' => '',
];
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  var_dump($_SERVER['REQUEST_METHOD'] === "POST", $_POST);
  $user = createUser($_POST);

  if (isset($_FILES['picture'])) {
    updloadImage($_FILES['picture'], $user);
  }

  header("Location: index.php");
}

?>

<?php include '_form.php'; ?>
