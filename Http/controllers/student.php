<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$schoolId = Session::getSchool_Id();

$students = $db->query('SELECT * FROM users WHERE school_id=:school_id AND role=:role ORDER BY id DESC', [
  'school_id' => $schoolId,
  'role' => 'student'
])->get();

// dd($students);


view('student.view.php', [
  'students' => $students
]);
