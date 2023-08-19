<?php

use Core\App;
use Core\Database;
use Core\Session;

$errors = [];
$db = App::resolve(Database::class);
$class = $db->query('SELECT * FROM classes WHERE class_id=:class_id', [
  'class_id' => $_GET['id']
])->find();

$user = $db->query('SELECT * FROM users WHERE user_id=:user_id', [
  'user_id' => $class['user_id']
])->find();

$result = false;
function getRole()
{
  $role = "";
  switch ($_GET['tab']) {
    case "lecturer-add":
      $role = "lecturer";
      break;
    case "student-add":
      $role = "student";
      break;
  }
  return $role;
}

function getTable()
{
  $role = "";
  switch ($_GET['tab']) {
    case "lecturer-add":
      $role = "classes_lecturer";
      break;
    case "student-add":
      $role = "classes_students";
      break;
  }
  return $role;
}

$role = getRole();
// dd($table);

if (isset($_POST['search'])) {
  if ($_POST['name'] === "") {
    $errors[] = "please type a name to search";
  }
  $name = empty(trim($_POST['name'])) ? "" : trim($_POST['name']) . "%";

  $result = $db->query('SELECT * FROM users WHERE( first_name LIKE :first_name || last_name LIKE :last_name) AND role=:role', [
    'first_name' => $name,
    'last_name' => $name,
    'role' => $role
  ])->get();

  Session::flash('old', ['name' => trim($_POST['name'])]);
} elseif (isset($_POST['selected']) && $_GET['tab'] === "lecturer-add") {
  $check = $db->query('SELECT * FROM classes_lecturer WHERE user_id=:user_id AND class_id=:class_id', [
    'user_id' => $_POST['selected'],
    'class_id' => $_GET['id']
  ])->find();

  if (!$check) {
    $res = $db->query('INSERT INTO classes_lecturer (user_id, class_id, school_id, disabled) VALUES (:user_id, :class_id, :school_id, :disabled)', [
      'user_id' => $_POST['selected'],
      'class_id' => $_GET['id'],
      'school_id' => Session::get('user')['school_id'],
      'disabled' => 0
    ]);
    if ($res) {
      redirect("/single_class?id={$_GET['id']}&tab=lecturer");
    }
  } else {
    $errors[] = "This Lecture already takes this class.";
  }
} elseif (isset($_POST['selected']) && $_GET['tab'] === "student-add") {
  $check = $db->query('SELECT * FROM classes_students WHERE user_id=:user_id AND class_id=:class_id', [
    'user_id' => $_POST['selected'],
    'class_id' => $_GET['id']
  ])->find();

  if (!$check) {
    $res = $db->query('INSERT INTO classes_students (user_id, class_id, school_id, disabled) VALUES (:user_id, :class_id, :school_id, :disabled)', [
      'user_id' => $_POST['selected'],
      'class_id' => $_GET['id'],
      'school_id' => Session::get('user')['school_id'],
      'disabled' => 0
    ]);
    if ($res) {
      redirect("/single_class?id={$_GET['id']}&tab=students");
    }
  } else {
    $errors[] = "This student already takes this class.";
  }
}

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturer';

view('classes/single.class.view.php', [
  'class' => $class,
  'user' => $user,
  'page_tab' => $tab,
  'result' => $result,
  'errors' => $errors
]);
