<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$school = $db->query('SELECT * FROM schools WHERE id=:id', ['id' => $_GET['id']])->findOrFail();

view('school/delete.view.php', [
  'school' => $school
]);
