<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$classes = $db->query('SELECT * FROM classes ORDER BY id DESC')->get();

$newClass = afterSelect($classes, 'user', $db);

view('classes/index.view.php', [
  'classes' => $newClass
]);
