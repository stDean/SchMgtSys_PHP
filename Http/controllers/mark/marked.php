<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$classId = $db->query("SELECT class_id FROM classes_lecturer WHERE user_id=:user_id", [
  'user_id' => Session::getUser_Id()
])->get();

// getting all test for a particular class by the logged in user
$allTests = [];
foreach ($classId as $key => $val) {
  $tests = $db->query("SELECT * FROM tests WHERE school_id=:school_id AND class_id=:class_id", [
    'school_id' => Session::getSchool_Id(),
    'class_id' => $val['class_id']
  ])->get();

  $allTests = array_merge($tests, $allTests);
}

$marked = [];
if (!empty($allTests)) {
  foreach ($allTests as $key => $test) {
    $res = $db->query("SELECT * FROM answered_tests WHERE test_id=:test_id AND submitted = 1 AND marked = 1", [
      'test_id' => $test['test_id']
    ])->get();

    if (isset($_GET['search'])) {
      $res = $db->query("SELECT answered_tests.*, tests.test_name FROM answered_tests JOIN tests ON answered_tests.test_id = tests.test_id WHERE  tests.test_name LIKE :keyword AND marked = 1 AND submitted = 1 AND answered_tests.test_id=:test_id", [
        'keyword' => trim($_GET['search']) . "%",
        'test_id' => $test['test_id']
      ])->get();
    }

    if (!empty($res)) {
      $response = [];
      foreach ($res as $key => $val) {
        $test = $db->query("SELECT * FROM tests WHERE test_id=:test_id ", [
          'test_id' => $test['test_id']
        ])->find();

        $val['test'] = $test;
        $response[] = $val;
      }
      $marked = array_merge($marked, $response);
    }
  }
} else {
  $tests = $db->query('SELECT test_id, test_name FROM tests WHERE school_id=:school_id', [
    'school_id' => Session::getSchool_Id()
  ])->get();

  $res = [];
  foreach ($tests as $test) {
    $resp = $db->query('SELECT * FROM answered_tests WHERE submitted = 1 AND marked = 1 AND test_id=:test_id', [
      'test_id' => $test['test_id']
    ])->get();

    if (isset($_GET['search'])) {
      $resp = $db->query("SELECT answered_tests.*, tests.test_name FROM answered_tests JOIN tests ON answered_tests.test_id = tests.test_id WHERE  tests.test_name LIKE :keyword AND marked = 1 AND submitted = 1 AND answered_tests.test_id=:test_id", [
        'keyword' => trim($_GET['search']) . "%",
        'test_id' => $test['test_id']
      ])->get();
    }
    $res = array_merge($res, $resp);
  }
  $response = [];
  foreach ($res as $val) {
    $test = $db->query("SELECT * FROM tests WHERE test_id=:test_id ", [
      'test_id' => $val['test_id']
    ])->find();
    $val['test'] = $test;
    $response[] = $val;
  }
  $marked = array_merge($marked, $response);
}

$marked = afterSelect($marked, 'user', $db);

view('mark/marked.test.view.php', [
  'marked' => $marked
]);
