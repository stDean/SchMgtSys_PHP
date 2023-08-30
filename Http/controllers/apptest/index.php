<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);


$tests = $db->query("SELECT * FROM tests WHERE school_id=:school_id ORDER BY id DESC", [
  'school_id' => Session::getSchool_Id()
])->get();

$testNUser = afterSelect($tests, 'user', $db);

view('apptest/index.view.php', [
  'title' => "Test",
  'tests' => $testNUser
]);
