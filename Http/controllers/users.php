<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$schoolId = Session::getSchool_Id();
// dd(Session::get('user'));

$users = $db->query("SELECT * FROM users WHERE school_id=:school_id AND role NOT IN ('student', 'super_admin') ORDER BY id DESC", [
  'school_id' => $schoolId,
])->get();


view('users.view.php', [
  'rows' => $users
]);
