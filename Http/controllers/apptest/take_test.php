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
  'test_id' => $_GET['id'] ?? false
])->find();

$class = $db->query('SELECT * FROM classes WHERE class_id=:class_id', [
  'class_id' => $test['class_id'] ?? false
])->find();

$test['class'] = $class;

$user = $db->query('SELECT * FROM users WHERE user_id=:user_id', [
  'user_id' => $test['user_id'] ?? false
])->find();

$questions = $db->query("SELECT * FROM test_questions WHERE test_id=:test_id ORDER BY id", [
  'test_id' => $_GET['id']
])->get();

if ($test) {
  if (!$test['disabled']) {
    $query = "UPDATE tests SET editable = 0 WHERE id=:id LIMIT 1";
    $db->query($query, [
      'id' => $test['id']
    ]);
  }
}

if (getUserRank() === "STUDENT") {
  view('apptest/take_test.view.php', [
    'test' => $test,
    'pager' => $pager,
    'user' => $user,
    'page_tab' => 'view',
    'questions' => $questions,
    'total_questions' => count($questions)
  ]);
} else {
  abort('403');
}
