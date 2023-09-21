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

$questions = $db->query("SELECT * FROM test_questions WHERE test_id=:test_id ORDER BY id DESC", [
  'test_id' => $_GET['id']
])->get();

if (isset($_GET['disable'])) {
  if ($_GET['disable'] === 'true') {
    $disable = 1;
    $editable = 1;
  } elseif ($_GET['disable'] === 'false') {
    $disable = 0;
    $editable = 1;
  }

  $db->query('UPDATE tests SET disabled=:disabled, editable=:editable WHERE test_id=:test_id LIMIT 1', [
    'test_id' => $_GET['id'],
    'disabled' => $disable,
    'editable' => $editable
  ]);
  header('location: /single_test?id=' . $test['test_id']);
}

$page_tab = 'view';
$scores = false;
if (isset($_GET['tab']) && $_GET['tab'] === 'scores') {
  $page_tab = 'scores';

  $res = $db->query("SELECT score, user_id FROM answered_tests WHERE test_id=:test_id AND submitted=1 AND marked=1 ORDER BY id DESC", [
    'test_id' => $_GET['id']
  ])->get();

  $scores = afterSelect($res, 'user', $db);
}

view('apptest/single_test.view.php', [
  'test' => $test,
  'pager' => $pager,
  'user' => $user,
  'page_tab' => $page_tab,
  'questions' => $questions,
  'total_questions' => count($questions),
  'scores' => $scores
]);
