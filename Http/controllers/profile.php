<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$id = isset($_GET['user']) ? $_GET['user'] : Session::getUser_Id();
$user = $db->query("SELECT * FROM users WHERE user_id=:user_id", [
  'user_id' => $id
])->find();

view('profile.view.php', [
  'user' => $user
]);
