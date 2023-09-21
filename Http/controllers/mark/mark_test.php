<?php

use Core\App;
use Core\Database;
use Core\Pagination;
use Core\Session;

$db = App::resolve(Database::class);

$limit = 3;
$pager = new Pagination($limit, 1, '&');
$offset = $pager->offset;
$pager = new Pagination($limit, 1, '&');

$test = $db->query('SELECT * FROM tests WHERE test_id=:test_id', [
  'test_id' => $_GET['test'] ?? false
])->find();

$class = $db->query('SELECT * FROM classes WHERE class_id=:class_id', [
  'class_id' => $test['class_id'] ?? false
])->find();

$test['class'] = $class;

$user = $db->query('SELECT * FROM users WHERE user_id=:user_id', [
  'user_id' => $test['user_id'] ?? false
])->find();

$questions = $db->query("SELECT * FROM test_questions WHERE test_id=:test_id ORDER BY id LIMIT $offset, $limit", [
  'test_id' => $_GET['test']
])->get();

$allQuestions = $db->query("SELECT id FROM test_questions WHERE test_id=:test_id", [
  'test_id' => $_GET['test']
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
  'SELECT correct_answer, question_id, answer_mark FROM answers WHERE user_id = :user_id AND test_id = :test_id',
  [
    'user_id' => $_GET['user'],
    'test_id' => $_GET['test'],
  ]
)->get();

$answeredTest = $db->query(
  'SELECT * FROM answered_tests WHERE user_id = :user_id AND test_id = :test_id',
  [
    'user_id' => $_GET['user'],
    'test_id' => $_GET['test'],
  ]
)->find();

if ($answeredTest) {
  $student = $db->query('SELECT * FROM users WHERE user_id = :user_id', [
    'user_id' => $answeredTest['user_id'],
  ])->find();
} else {
  $student = [];
}

if (isset($student)) {
  foreach ($questions as $question) {
    $markedPercent = getMarkedPercentage($test['test_id'], $student['user_id']);
  }
}

if (isset($_GET['unsubmit'])) {
  $db->query('DELETE FROM answered_tests WHERE test_id=:test_id AND user_id=:user_id', [
    'user_id' => $_GET['user'],
    'test_id' => $_GET['test'],
  ]);

  header('location: /mark_test');
} elseif (isset($_GET['auto'])) {
  // $db->query('DELETE FROM answered_tests WHERE test_id=:test_id AND user_id=:user_id', [
  //   'user_id' => $_GET['user'],
  //   'test_id' => $_GET['test'],
  // ]);

  // header('location: /mark?test=' . $_GET['test'] . '&user=' . $_GET['user']);
} elseif (isset($_GET['marked']) && $markedPercent >= 100) {
  $db->query('UPDATE answered_tests SET marked=:marked, marked_date=:marked_date, marked_by=:marked_by, score=:score WHERE test_id=:test_id AND user_id=:user_id', [
    'marked' => 1,
    'marked_by' => Session::getUser_Id(),
    'marked_date' => date("Y-m-d H:i:s"),
    'user_id' => $_GET['user'],
    'test_id' => $_GET['test'],
    'score' => getScorePercentage($_GET['test'], $_GET['user'])
  ]);

  header('location: /mark?test=' . $_GET['test'] . '&user=' . $_GET['user']);
}

view('mark/mark-single.view.php', [
  'test' => $test,
  'pager' => $pager,
  'user' => $user,
  'page_tab' => 'view',
  'questions' => $questions,
  'total_questions' => count($allQuestions),
  'errors' => Session::get('errors'),
  'answers' => $answers,
  'answeredTest' => $answeredTest,
  'student' => $student
]);
