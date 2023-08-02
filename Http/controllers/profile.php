<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$user = $db->query("SELECT * FROM users WHERE user_id=:user_id", [
  'user_id' => $_GET['id']
])->find();

view('profile.view.php', [
  'user' => $user
]);
