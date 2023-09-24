<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$keyword = isset($_GET['search']) ? $_GET['search'] : false;
$year = !empty($_SESSION['school_year']->year) ? $_SESSION['school_year']->year : date("Y", time());

if (access('admin') || getUserRank() === 'RECEPTION') {
  $classes = $db->query('SELECT * FROM classes WHERE school_id=:school_id AND YEAR(createdAt) LIKE :year ORDER BY id DESC', [
    'school_id' => Session::getSchool_Id(),
    'year' => $year
  ])->get();

  if ($keyword) {
    $classes = $db->query(
      'SELECT * FROM classes WHERE school_id=:school_id AND class_name LIKE :keyword AND YEAR(createdAt) LIKE :year ORDER BY id DESC',
      [
        'school_id' => Session::getSchool_Id(),
        'keyword' => trim($keyword) . "%",
        'year' => $year
      ]
    )->get();
  }
} else {
  $rank = Session::getRole();
  $table = "classes_students";

  if ($rank === 'lecturer') {
    $table = "classes_lecturer";
  }

  $query = "SELECT * FROM classes WHERE class_id IN (SELECT class_id FROM $table WHERE user_id=:user_id) AND YEAR(createdAt) LIKE :year";

  if ($keyword) {
    $query = "SELECT * FROM classes WHERE class_id IN (SELECT $table.class_id FROM $table JOIN classes ON $table.class_id = classes.class_id WHERE $table.user_id=:user_id AND class_name LIKE :keyword) AND YEAR(createdAt) LIKE :year";

    $arr['keyword'] = trim($keyword) . "%";
  }

  $arr['year'] = $year;
  $arr['user_id'] = Session::getUser_Id();

  $classes = $db->query($query, $arr)->get();
}

$newClass = afterSelect($classes, 'user', $db);

view('classes/index.view.php', [
  'classes' => $newClass,
  'title' => 'Class'
]);
