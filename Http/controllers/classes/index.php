<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$keyword = isset($_GET['search']) ? $_GET['search'] : false;

if (access('admin') || getUserRank() === 'RECEPTION') {
  $classes = $db->query('SELECT * FROM classes WHERE school_id=:school_id ORDER BY id DESC', [
    'school_id' => Session::getSchool_Id()
  ])->get();

  if ($keyword) {
    $classes = $db->query(
      'SELECT * FROM classes WHERE school_id=:school_id AND class_name LIKE :keyword ORDER BY id DESC',
      [
        'school_id' => Session::getSchool_Id(),
        'keyword' => trim($keyword) . "%"
      ]
    )->get();
  }
} else {
  $rank = Session::getRole();
  $table = "classes_students";

  if ($rank === 'LECTURER') {
    $table = "classes_lecturer";
  }

  $person = $db->query("SELECT * FROM $table WHERE user_id=:user_id", [
    'user_id' => Session::getUser_Id()
  ])->get();

  if ($keyword) {
    $person = $db->query(
      "SELECT $table.*, classes.class_name FROM $table JOIN classes ON $table.class_id = classes.class_id WHERE $table.user_id=:user_id AND class_name LIKE :keyword",
      [
        'user_id' => Session::getUser_Id(),
        'keyword' => "%" . $keyword . "%"
      ]
    )->get();
  }

  $classes = [];

  if ($person) {
    foreach ($person as $key => $val) {
      $classes[] = $db->query("SELECT * FROM classes WHERE class_id=:class_id", [
        'class_id' => $val['class_id']
      ])->find();
    }
  }
}

$newClass = afterSelect($classes, 'user', $db);

view('classes/index.view.php', [
  'classes' => $newClass,
  'title' => 'Class'
]);
