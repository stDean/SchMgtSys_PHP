<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$year = !empty($_SESSION['school_year']->year) ? $_SESSION['school_year']->year : date("Y", time());

$classId = $db->query("SELECT class_id FROM classes_lecturer WHERE user_id=:user_id", [
  'user_id' => Session::getUser_Id()
])->get();

// getting all test for a particular class
$allTests = [];
foreach ($classId as $key => $val) {
  $tests = $db->query("SELECT * FROM tests WHERE school_id=:school_id AND class_id=:class_id ORDER BY id DESC", [
    'school_id' => Session::getSchool_Id(),
    'class_id' => $val['class_id']
  ])->get();

  $allTests = array_merge($tests, $allTests);
}

$toMark = [];
if ($allTests) {
  foreach ($allTests as $key => $test) {
    $res = $db->query("SELECT * FROM answered_tests WHERE test_id=:test_id AND submitted=1 AND marked=0 AND YEAR(created_at) LIKE :year", [
      'test_id' => $test['test_id'],
      'year' => $year
    ])->get();

    if (isset($_GET['search'])) {
      $res = $db->query(
        "SELECT answered_tests.*, tests.test_name FROM answered_tests JOIN tests ON answered_tests.test_id=tests.test_id WHERE answered_tests.test_id=:test_id AND submitted=1 AND marked=0 AND test_name LIKE :keyword AND YEAR(created_at) LIKE :year",
        [
          'test_id' => $test['test_id'],
          'keyword' => trim($_GET['search']) . "%",
          'year' => $year
        ]
      )->get();
    }

    if (!empty($res)) {
      $response = [];
      foreach ($res as $key => $val) {
        if (is_array($val)) {
          $test = $db->query("SELECT * FROM tests WHERE test_id=:test_id ", [
            'test_id' => $test['test_id']
          ])->find();

          $val['test'] = $test;
          $response[] = $val;
        }
      }
      $toMark = array_merge($toMark, $response);
    }
  }
}

$toMark = afterSelect($toMark, 'user', $db);

view('mark/mark.test.view.php', [
  'toMark' => $toMark,
]);
