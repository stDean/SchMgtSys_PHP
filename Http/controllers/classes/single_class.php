<?php

use Core\App;
use Core\Database;
use Core\Pagination;

$db = App::resolve(Database::class);
$class = $db->query('SELECT * FROM classes WHERE class_id=:class_id', [
  'class_id' => $_GET['id']
])->find();

$user = $db->query('SELECT * FROM users WHERE user_id=:user_id', [
  'user_id' => $class['user_id']
])->find();

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturer';

$limit = 4;
$pager = new Pagination($limit, 1, '&');
$offset = $pager->offset;

if ($tab === "lecturer") {
  $data = $db->query(
    "SELECT * FROM classes_lecturer WHERE class_id=:class_id ORDER BY id DESC LIMIT $offset, $limit",
    [
      'class_id' => $_GET['id']
    ]
  )->get();
} else {
  $data = $db->query(
    "SELECT * FROM classes_students WHERE class_id=:class_id ORDER BY id DESC LIMIT $offset, $limit",
    [
      'class_id' => $_GET['id']
    ]
  )->get();
}

$results = afterSelect($data, 'user', $db);

view('classes/single.class.view.php', [
  'class' => $class,
  'user' => $user,
  'page_tab' => $tab,
  'data' => $results,
  'pager' => $pager
]);
