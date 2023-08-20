<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$classes = $db->query('SELECT * FROM classes WHERE school_id=:school_id ORDER BY id DESC', [
  'school_id' => Session::getSchool_Id()
])->get();

$newClass = afterSelect($classes, 'user', $db);

view('classes/index.view.php', [
  'classes' => $newClass
]);
