<?php

use Core\App;
use Core\Auth\QuestionAuth;
use Core\Database;
use Http\Form\QuestionForm;

$attributes = [
  'question' => $_POST['question'],
  'question_type' => 'theory',
  'choices' => NULL,
  'correct_answer' => NULL,
  'test_id' => $_GET['id'],
  'image' => $_FILES['image'],
];

$db = App::resolve(Database::class);

if ($attributes['image'] && $attributes['image']['tmp_name']) {
  $attributes['image'] = makeImagePath($attributes['image']);
} else {
  $attributes['image'] = NULL;
}

$form = QuestionForm::validate($attributes);
$storedQuestion = (new QuestionAuth)->attempt($attributes);

if (!$storedQuestion) {
  $form->error('question', 'Something went wrong')->throw();
}

redirect('/single_test?id=' . $attributes['test_id']);
