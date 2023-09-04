<?php

use Core\App;
use Core\Auth\UpdateQuestion;
use Core\Database;
use Http\Form\QuestionForm;

$db = App::resolve(Database::class);

$attributes = [
  'question' => $_POST['question'],
  'choices' => NULL,
  'correct_answer' => $_GET['type'] === 'german' ? $_POST['correct_answer'] : NULL,
  'image' => $_FILES['image'],
  'comment' => $_POST['comment'] !== "" ? $_POST['comment'] : NULL,
];

if ($attributes['image'] && $attributes['image']['tmp_name']) {
  $attributes['image'] = uploadImage($attributes['image']);
} else {
  $attributes['image'] = NULL;
}

$form = QuestionForm::validate($attributes);
$updateQuestion = (new UpdateQuestion)->attempt($attributes);

redirect('/single_test/editquestion?id=' . $_GET['id'] . '&tab=edit&type=' . $_GET['type'] . '&quesId=' . $_GET['quesId']);
