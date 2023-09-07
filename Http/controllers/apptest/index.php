<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

if (access('admin') || getUserRank() === "RECEPTION") {
  $tests = $db->query("SELECT * FROM tests WHERE school_id=:school_id ORDER BY id DESC", [
    'school_id' => Session::getSchool_Id()
  ])->get();
} else {
  $table = getUserRank() === "STUDENT" ? 'classes_students' : 'classes_lecturer';

  $classId = $db->query("SELECT class_id FROM {$table} WHERE user_id=:user_id", [
    'user_id' => Session::getUser_Id()
  ])->get();

  foreach ($classId as $key => $val) {
    // dump($val);
    if (getUserRank() === 'STUDENT') {
      $tests = $db->query("SELECT * FROM tests WHERE school_id=:school_id AND class_id=:class_id AND disabled = 0 ORDER BY id DESC", [
        'school_id' => Session::getSchool_Id(),
        'class_id' => $val['class_id']
      ])->get();
    } else {
      $tests = $db->query("SELECT * FROM tests WHERE school_id=:school_id AND class_id=:class_id ORDER BY id DESC", [
        'school_id' => Session::getSchool_Id(),
        'class_id' => $val['class_id']
      ])->get();
    }
  }

  // dd($tests);
}

$testNUser = afterSelect($tests, 'user', $db);

view('apptest/index.view.php', [
  'title' => "Test",
  'tests' => $testNUser
]);
