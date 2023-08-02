<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$users = $db->query('SELECT * FROM users')->get();

view('users.view.php', [
  'rows' => $users
]);
