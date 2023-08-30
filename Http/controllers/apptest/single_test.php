<?php

use Core\App;
use Core\Database;
use Core\Pagination;

$db = App::resolve(Database::class);

$limit = 4;
$pager = new Pagination($limit, 1, '&');
$offset = $pager->offset;
$pager = new Pagination($limit, 1, '&');

$test = $db->query('SELECT * FROM tests WHERE test_id=:test_id', [
  'test_id' => $_GET['id']
])->find();

$user = $db->query('SELECT * FROM users WHERE user_id=:user_id', [
  'user_id' => $test['user_id']
])->find();

view('apptest/single_test.view.php', [
  'test' => $test,
  'pager' => $pager,
  'user' => $user,
  'page_tab' => 'view'
]);
