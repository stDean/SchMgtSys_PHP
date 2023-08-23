<?php

use Core\App;
use Core\Database;
use Core\Pagination;
use Core\Session;

$db = App::resolve(Database::class);
$schoolId = Session::getSchool_Id();

$limit = 4;
$pager = new Pagination($limit);
$offset = $pager->offset;

$keyword = isset($_GET['search']) ? $_GET['search'] : false;

$students = $db->query("SELECT * FROM users WHERE school_id=:school_id AND role IN ('student') ORDER BY id DESC LIMIT $offset, $limit", [
  'school_id' => $schoolId,
])->get();

if ($keyword) {
  $students = $db->query(
    "SELECT * FROM users WHERE school_id=:school_id AND role IN ('student') AND (first_name LIKE :keyword || last_name LIKE :keyword) ORDER BY id DESC LIMIT $offset, $limit ",
    [
      'school_id' => $schoolId,
      'keyword' => "%" . $keyword . "%"
    ]
  )->get();
}

view('student.view.php', [
  'students' => $students,
  'pager' => $pager
]);
