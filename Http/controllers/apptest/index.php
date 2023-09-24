<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$keyword = isset($_GET['search']) ? $_GET['search'] : false;
$year = !empty($_SESSION['school_year']->year) ? $_SESSION['school_year']->year : date("Y", time());

if (access('admin') || getUserRank() === "RECEPTION") {
  $query = "SELECT * FROM tests WHERE school_id=:school_id AND YEAR(createdAt) LIKE :year ORDER BY id DESC";
  $arr['school_id'] = Session::getSchool_Id();

  if ($keyword) {
    $query = 'SELECT * FROM tests WHERE school_id=:school_id AND test_name LIKE :keyword AND YEAR(createdAt) LIKE :year ORDER BY id DESC';
    $arr['keyword'] = trim($keyword) . "%";
  }

  $arr['year'] = $year;

  $tests = $db->query($query, $arr)->get();
} else {
  $table = 'classes_lecturer';
  $disabled = "";

  if (getUserRank() === 'STUDENT') {
    $table = 'classes_students';
    $disabled = "AND disabled=0";
  }

  // using sub-queries
  $query = "SELECT * FROM tests WHERE school_id=:school_id AND class_id IN (SELECT class_id FROM {$table} WHERE user_id=:user_id) AND YEAR(createdAt) LIKE :year {$disabled} ORDER BY id DESC";

  if ($keyword) {
    $query = "SELECT * FROM  tests WHERE school_id=:school_id AND class_id IN (SELECT class_id FROM {$table} WHERE user_id=:user_id) AND test_name LIKE :keyword AND YEAR(createdAt) LIKE :year {$disabled} ORDER BY id DESC";
    $arr['keyword'] = trim($keyword) . "%";
  }

  $arr['school_id'] = Session::getSchool_Id();
  $arr['year'] = $year;
  $arr['user_id'] = Session::getUser_Id();
  $tests = $db->query($query, $arr)->get();
}

$testNUser = afterSelect($tests, 'user', $db);

view('apptest/index.view.php', [
  'title' => "Test",
  'tests' => $testNUser,
  'unSubmittedTest' => unSubmittedTest()
]);
