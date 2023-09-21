<?php

use Core\App;
use Core\Auth\SubmitAnswer;
use Core\Auth\SubmitForMark;
use Core\Database;
use Core\Session;
use Http\Form\AnswerForm;

$db = App::resolve(Database::class);

$attributes = [
  'user_id' => Session::getUser_Id(),
  'test_id' => $_GET['id']
];

$att2 = [
  'user_id' => $attributes['user_id'],
  'test_id' => $attributes['test_id'],
];

if (isset($_GET['submit'])) {
  $att2['submitted'] = 1;
  
  $submitForMark = (new SubmitForMark)->attempt($att2);

  header('location: /single_test?id=' . $_GET['id']);
}

$form = AnswerForm::validate($attributes);

foreach ($_POST as $key => $val) {
  if (is_numeric($key)) {
    $attributes['question_id'] = $key;
    $attributes['correct_answer'] = trim($val);

    $submitAnswer = (new SubmitAnswer)->attempt($attributes);
  }
}

if (!$submitAnswer) {
  $form->error('user_id', 'Cannot retake test')->throw();
}

$pageNo = '&page=1';
if (!empty($_GET['page'])) {
  $pageNo = '&page=' . $_GET['page'];
}

redirect('/taketest?id=' . $_GET['id'] . $pageNo);
