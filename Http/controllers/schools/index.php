<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$schools = $db->query('SELECT * FROM schools')->get();

$newSch = afterSelect($schools, 'user', $db);

view('school/index.view.php', [
  'schools' => $newSch
]);
