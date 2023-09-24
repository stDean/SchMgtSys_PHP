<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$id = isset($_GET['user']) ? $_GET['user'] : Session::getUser_Id();
$year = !empty($_SESSION['school_year']->year) ? $_SESSION['school_year']->year : date("Y", time());

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
      $allClasses[] = $db->query("SELECT * FROM classes WHERE class_id=:class_id AND YEAR(createdAt) LIKE :year", [
        'class_id' => $val['class_id'],
        'year' => $year
      ])->find();
    }
    $user['classes'] = afterSelect($allClasses, 'user', $db);
  }
} elseif ($tab === "test") {
  $table = "classes_students";
  $disabled = "AND disabled=0";

  if ($user['role'] === 'lecturer') {
    $table = "classes_lecturer";
    $disabled = "";
  }
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
    $marked = [];

    if (getUserRank() === "STUDENT") {
      $query = "SELECT * FROM tests WHERE class_id IN ($strId) AND disabled = 0";
      $tests = $db->query($query)->get();

      foreach ($tests as $key => $test) {
        $res = $db->query("SELECT * FROM answered_tests WHERE test_id=:test_id AND submitted = 1 AND marked = 1 AND user_id=:user_id AND YEAR(created_at) LIKE :year LIMIT 1", [
          'test_id' => $test['test_id'],
          'user_id' => $_GET['user'],
          'year' => $year
        ])->get();

        if (is_array($res)) {
          $test = $db->query("SELECT * FROM tests WHERE test_id=:test_id ", [
            'test_id' => $test['test_id']
          ])->find();
          if (isset($res[0])) {
            $res[0]['test'] = $test;
          }
          $marked = array_merge($marked, $res);
        }
      }

      $user['tests'] = afterSelect($marked, 'user', $db);
    } else {
      $query = "SELECT * FROM tests WHERE class_id IN (SELECT class_id FROM {$table} WHERE user_id = :user_id) AND YEAR(createdAt) LIKE :year ORDER BY id DESC";

      if (isset($_GET['search'])) {
        $query = "SELECT * FROM tests WHERE class_id IN (SELECT class_id FROM {$table} WHERE user_id=:user_id) AND test_name LIKE :keyword {$disabled} AND YEAR(createdAt) LIKE :year ORDER BY id DESC";

        $arr['keyword'] = trim($_GET['search']) . "%";
      }

      $arr['user_id'] = $_GET['user'];
      $arr['year'] = $year;
      $tests = $db->query($query, $arr)->get();

      $user['tests'] = afterSelect($tests, 'user', $db);
    }
  } else {
    $tests = [];
  }
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
