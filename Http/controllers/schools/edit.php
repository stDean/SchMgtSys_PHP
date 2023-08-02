<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$school = $db->query('SELECT * FROM schools WHERE id=:id', ['id' => $_GET['id']])->findOrFail();

view('school/edit.view.php', [
  'school' => $school,
  'errors' => Session::get('errors')
]);
