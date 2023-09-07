<?php

use Core\App;
use Core\Auth\QuestionAuth;
use Core\Database;
use Http\Form\QuestionForm;

$attributes = [
  'question' => $_POST['question'],
  'question_type' => isset($_GET['type']) ? $_GET['type'] : 'theory',
  'choices' => NULL,
  'correct_answer' => isset($_GET['type']) ? $_POST['correct_answer'] : NULL,
  'test_id' => $_GET['id'],
  'image' => $_FILES['image'],
  'comment' => $_POST['comment'] !== "" ? $_POST['comment'] : NULL,
];

$db = App::resolve(Database::class);

if ($attributes['image'] && $attributes['image']['tmp_name']) {
  $attributes['image'] = uploadImage($attributes['image']);
} else {
  $attributes['image'] = NULL;
}

if ($attributes['question_type'] === 'multiple') {
  $num = 0;
  $letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];
  $choiceArr = [];

  foreach ($_POST as $key => $val) {
    if (strstr($key, 'choice')) {
      $choiceArr[$letters[$num]] = $val;
      $num++;
    }
  }
  $attributes['choices'] = json_encode($choiceArr);
}

$form = QuestionForm::validate($attributes);
$storedQuestion = (new QuestionAuth)->attempt($attributes);

if (!$storedQuestion) {
  $form->error('question', 'Question already exists.')->throw();
}

redirect('/single_test?id=' . $attributes['test_id']);
