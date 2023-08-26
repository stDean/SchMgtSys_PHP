<?php

use Core\App;
use Core\Database;

// $attributes = [
//   'test_name' => $_POST['test_name'] || null
// ];

$db = App::resolve(Database::class);

$tests = [];

$testNUser = afterSelect($tests, 'user', $db);

view('apptest/index.view.php', [
  'title' => "Test",
  'tests' => $testNUser
]);
