<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$keyword = isset($_GET['search']) ? $_GET['search'] : false;
$tests = [];

if (access('admin') || getUserRank() === "RECEPTION") {
  $query = "SELECT * FROM tests WHERE school_id=:school_id ORDER BY id DESC";
  $arr['school_id'] = Session::getSchool_Id();

  if ($keyword) {
    $query = 'SELECT * FROM tests WHERE school_id=:school_id AND test_name LIKE :keyword ORDER BY id DESC';
    $arr['keyword'] = trim($keyword) . "%";
  }
  $tests[] = $db->query($query, $arr)->get();
} else {
  $table = getUserRank() === "STUDENT" ? 'classes_students' : 'classes_lecturer';

  $classId = $db->query("SELECT class_id FROM {$table} WHERE user_id=:user_id", [
    'user_id' => Session::getUser_Id()
  ])->get();

  // $tests = [];

  foreach ($classId as $key => $val) {
    if (getUserRank() === 'STUDENT') {
      $query = "SELECT * FROM tests WHERE school_id=:school_id AND class_id=:class_id AND disabled = 0 ORDER BY id DESC";
      $arr['school_id'] = Session::getSchool_Id();
      $arr['class_id'] = $val['class_id'];

      if ($keyword) {
        $query = "SELECT * FROM  tests WHERE school_id=:school_id AND class_id=:class_id  AND test_name LIKE :keyword ";
        $arr['keyword'] = trim($keyword) . "%";
      }

      $tests[] = $db->query($query, $arr)->get();
    } else {
      $query = "SELECT * FROM tests WHERE school_id=:school_id AND class_id=:class_id ORDER BY id DESC";
      $arr['school_id'] = Session::getSchool_Id();
      $arr['class_id'] = $val['class_id'];

      if ($keyword) {
        $query = "SELECT * FROM  tests WHERE school_id=:school_id AND class_id=:class_id  AND test_name LIKE :keyword ";
        $arr['keyword'] = trim($keyword) . "%";
      }

      $tests[] = $db->query($query, $arr)->get();
    }
  }
  // dump($tests);
}

$testNUser = [];
foreach ($tests as $test) {
  if (!empty($test)) {
    $testNUser = array_merge(afterSelect($test, 'user', $db), $testNUser);
  }
}
// dump($testNUser);

view('apptest/index.view.php', [
  'title' => "Test",
  'tests' => $testNUser
]);
