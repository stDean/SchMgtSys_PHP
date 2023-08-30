<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$tab = $_GET['tab'];

if ($tab === "lecturer") {
  $db->query('DELETE FROM classes_lecturer WHERE user_id=:user_id AND class_id=:class_id', [
    'user_id' => $_POST['user_id'],
    'class_id' => $_GET['id']
  ]);
} elseif ($tab === "students") {
  $db->query('DELETE FROM classes_students WHERE user_id=:user_id AND class_id=:class_id', [
    'user_id' => $_POST['user_id'],
    'class_id' => $_GET['id']
  ]);
} elseif ($tab === "test-delete") {
  $db->query('DELETE FROM tests WHERE test_name=:test_name', [
    'test_name' => $_POST['test_name']
  ]);

  redirect("/single_class?id={$_GET['id']}&tab=tests");
}

redirect("/single_class?id={$_GET['id']}&tab=$tab");
