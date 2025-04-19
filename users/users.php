<?php

const EXTENTIONS = ['jpg', 'png'];

function getUsers()
{
  $users = json_decode(file_get_contents(__DIR__ . '/users.json'), true);
  return $users;
}

function getUserById($id)
{
  $users = getUsers();

  foreach ($users as $user) {
    if ($id == $user['id']) {
      return $user;
    }
  }
  return null;
}

function createUser($data)
{
  $users = getUsers();

  $data['id'] = rand(1000000, 2000000);
  $users[] = $data;
  putJson($users);

  return $data;
}

function updateUser($data, $id)
{
  $updatedUser = [];
  $users = getUsers();
  foreach ($users as $i => $user) {
    if ($user['id'] == $id) {
      $users[$i] = $updatedUser = array_merge($user, $data);
    }
  }

  putJson($users);
  return $updatedUser;
}

function updloadImage($file, $user)
{
  if (isset($_FILES['picture']) && $_FILES['picture']['name']) {
    if (!is_dir(__DIR__ . "/images")) {
      mkdir(__DIR__ . "/images");
    }

    $fileName = $file['name'];
    $dotPosition = strrpos($fileName, '.');
    $extention = substr($fileName, $dotPosition + 1);
    move_uploaded_file($file['tmp_name'], __DIR__ . "/images/{$user['id']}.$extention");

    if (!isset($user['extention'])) {
      $user['extention'] = $extention;
    } else if (isset($user['extention']) && in_array($extention, EXTENTIONS)) {
      $user['extention'] = $extention;
    }
    updateUser($user, $user['id']);
  }
}

function deleteUser($id)
{
  $users = getUsers();

  foreach ($users as $i => $user) {
    if ($user['id'] == $id) {
      array_splice($users, $i, 1);
    }
  }

  putJson($users);
}

function putJson($users)
{
  file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}
