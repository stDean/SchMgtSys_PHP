<?php

use Core\App;
use Core\Auth\SubmitForMark;
use Core\Database;
use Core\Pagination;
use Core\Session;

$db = App::resolve(Database::class);

$limit = 2;
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

$questions = $db->query("SELECT * FROM test_questions WHERE test_id=:test_id ORDER BY id LIMIT $offset, $limit", [
  'test_id' => $_GET['id']
])->get();

$allQuestions = $db->query("SELECT id FROM test_questions WHERE test_id=:test_id", [
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

$answers = $db->query(
  'SELECT correct_answer, question_id FROM answers WHERE user_id = :user_id AND test_id = :test_id',
  [
    'user_id' => Session::getUser_Id(),
    'test_id' => $_GET['id'],
  ]
)->get();

$answeredTest = $db->query(
  'SELECT * FROM answered_tests WHERE user_id = :user_id AND test_id = :test_id',
  [
    'user_id' => Session::getUser_Id(),
    'test_id' => $_GET['id'],
  ]
)->find();

if (isset($_GET['submit'])) {
  $att2 = [
    'user_id' => Session::getUser_Id(),
    'test_id' => $_GET['id']
  ];
  $att2['submitted'] = 1;

  $submitForMark = (new SubmitForMark)->attempt($att2);

  header('location: /taketest?id=' . $_GET['id']);
}

if (getUserRank() === "STUDENT") {
  view('apptest/take_test.view.php', [
    'test' => $test,
    'pager' => $pager,
    'user' => $user,
    'page_tab' => 'view',
    'questions' => $questions,
    'total_questions' => count($allQuestions),
    'errors' => Session::get('errors'),
    'answers' => $answers,
    'answeredTest' => $answeredTest
  ]);
} else {
  abort('403');
}
