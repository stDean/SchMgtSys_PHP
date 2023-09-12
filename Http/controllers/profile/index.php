<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$id = isset($_GET['user']) ? $_GET['user'] : Session::getUser_Id();

$user = $db->query("SELECT * FROM users WHERE user_id=:user_id", [
  'user_id' => $id
])->find();

function fetchPerson($user, $db)
{
  $table = "classes_students";
  if ($user['role'] === 'lecturer') {
    $table = "classes_lecturer";
  }
  return $db->query("SELECT * FROM $table WHERE user_id=:user_id", [
    'user_id' => $_GET['user']
  ])->get();
}


$tab = isset($_GET['tab']) ? $_GET['tab'] : 'info';

if ($tab === "classes") {
  $person = fetchPerson($user, $db);
  $allClasses = [];

  if ($person) {
    foreach ($person as $key => $val) {
      $allClasses[] = $db->query("SELECT * FROM classes WHERE class_id=:class_id", [
        'class_id' => $val['class_id']
      ])->find();
    }
    $user['classes'] = afterSelect($allClasses, 'user', $db);
  }
} elseif ($tab === "test") {
  $person = fetchPerson($user, $db);
  $allClasses = [];

  if ($person) {
    foreach ($person as $key => $val) {
      $allClasses[] = $db->query("SELECT * FROM classes WHERE class_id=:class_id", [
        'class_id' => $val['class_id']
      ])->find();
    }
    $user['classes'] = afterSelect($allClasses, 'user', $db);

    // getting class ids
    $classId = [];
    foreach ($user['classes'] as $key => $val) {
      $classId[] = $val['class_id'];
    }
  }

  if (isset($classId)) {
    $strId = "'" . implode("','", $classId) . "'";
    if (getUserRank() === "STUDENT") {
      $query = "SELECT * FROM tests WHERE class_id IN ($strId) AND disabled = 0";
    } else {
      $query = "SELECT * FROM tests WHERE class_id IN ($strId)";
    }
    $tests = $db->query($query)->get();
  } else {
    $tests = [];
  }

  $user['tests'] = afterSelect($tests, 'user', $db);
}

if (access('reception') || canModifyContent($user)) {
  view('profile/index.view.php', [
    'user' => $user,
    'page_tab' => $tab,
    'title' => 'Class'
  ]);
} else {
  abort(403);
}
