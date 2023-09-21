<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

if ($_POST) {
  $attributes = [];
  foreach ($_POST as $key => $val) {
    if (is_numeric($key)) {
      $attributes['question_id'] = $key;
      $attributes['answer_mark'] = trim($val);
      $attributes['user_id'] = $_GET['user'];
      $attributes['test_id'] = $_GET['test'];

      $db->query('UPDATE answers SET answer_mark=:answer_mark WHERE test_id=:test_id AND user_id=:user_id AND question_id=:question_id', $attributes);
    }
  }

  redirect('/mark?test=' . $_GET['test'] . '&user=' . $_GET['user']);
} else {
  Session::flash('errors', ['No Answer to submit']);

  redirect('/mark?test=' . $_GET['test'] . '&user=' . $_GET['user']);
}
