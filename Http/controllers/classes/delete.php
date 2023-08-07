<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$class = $db->query('SELECT * FROM classes WHERE id=:id', ['id' => $_GET['id']])->findOrFail();

view('classes/delete.view.php', [
  'class' => $class
]);
