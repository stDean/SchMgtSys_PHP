<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$class = $db->query('SELECT * FROM classes WHERE id=:id', ['id' => $_GET['id']])->findOrFail();

if (canModifyContent($class)) {
  view('classes/edit.view.php', [
    'class' => $class,
    'errors' => Session::get('errors')
  ]);
} else {
  abort('403');
}
