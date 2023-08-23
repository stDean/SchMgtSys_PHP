<?php

use Core\App;
use Core\Database;
use Core\Pagination;
use Core\Session;

$db = App::resolve(Database::class);
$schoolId = Session::getSchool_Id();
$keyword = isset($_GET['search']) ? $_GET['search'] : false;

$limit = 4;
$pager = new Pagination($limit);
$offset = $pager->offset;

if ($keyword) {
  $users = $db->query(
    "SELECT * FROM users WHERE school_id=:school_id AND role NOT IN ('student', 'super_admin') AND (first_name LIKE :keyword || last_name LIKE :keyword) ORDER BY id DESC LIMIT $offset, $limit",
    [
      'school_id' => $schoolId,
      'keyword' => "%" . $keyword . "%"
    ]
  )->get();
} else {
  $users = $db->query(
    "SELECT * FROM users WHERE school_id=:school_id AND role NOT IN ('student', 'super_admin') ORDER BY id DESC LIMIT $offset, $limit",
    [
      'school_id' => $schoolId,
    ]
  )->get();
}


view('users.view.php', [
  'rows' => $users,
  'pager' => $pager
]);
