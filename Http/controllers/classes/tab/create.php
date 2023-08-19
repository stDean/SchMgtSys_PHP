<?php

use Core\App;
use Core\Database;

$result = false;
$db = App::resolve(Database::class);
$class = $db->query('SELECT * FROM classes WHERE class_id=:class_id', [
  'class_id' => $_GET['id']
])->find();

$user = $db->query('SELECT * FROM users WHERE user_id=:user_id', [
  'user_id' => $class['user_id']
])->find();

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturer';

view('classes/single.class.view.php', [
  'class' => $class,
  'user' => $user,
  'page_tab' => $tab,
  'lecturers' => $result
]);
