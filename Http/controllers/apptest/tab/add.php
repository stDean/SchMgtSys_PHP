<?php

use Core\App;
use Core\Database;
use Core\Pagination;
use Core\Session;

// $attributes = [
//   'question' => $_POST['question'],
//   'question_type' => $_POST['question_type'],
//   'correct_answer' => $_POST['correct_answer'],
//   'choices' => $_POST['choices'],
//   'test_id' => $_GET['id'],
//   'image' => null
// ];

$db = App::resolve(Database::class);

$limit = 4;
$pager = new Pagination($limit, 1, '&');
$offset = $pager->offset;
$pager = new Pagination($limit, 1, '&');

$type = isset($type) ? $_GET['type'] : 'theory';

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
  'page_tab' => 'add-theory',
  'errors' => Session::get('errors')
]);
