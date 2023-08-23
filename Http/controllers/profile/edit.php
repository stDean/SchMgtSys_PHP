<?php

use Core\App;
use Core\Database;
use Core\Session;

$errors = [];
$db = App::resolve(Database::class);
$id = isset($_GET['user']) ? $_GET['user'] : Session::getUser_Id();

$user = $db->query("SELECT * FROM users WHERE user_id=:user_id", [
  'user_id' => $id
])->find();

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'info';

if ($tab === "classes") {
  $table = "classes_students";
  if ($user['role'] === 'lecturer') {
    $table = "classes_lecturer";
  }
  $person = $db->query("SELECT * FROM $table WHERE user_id=:user_id", [
    'user_id' => $_GET['user']
  ])->get();

  $allClasses = [];

  if ($person) {
    foreach ($person as $key => $val) {
      $allClasses[] = $db->query("SELECT * FROM classes WHERE class_id=:class_id", [
        'class_id' => $val['class_id']
      ])->find();
    }
    $user['classes'] = afterSelect($allClasses, 'user', $db);
  }
}


view('profile/edit.view.php', [
  'user' => $user,
  'page_tab' => $tab,
  'errors' => $errors
]);
