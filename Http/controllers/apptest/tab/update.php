<?php

use Core\App;
use Core\Auth\UpdateQuestion;
use Core\Database;
use Http\Form\QuestionForm;

$db = App::resolve(Database::class);

$attributes = [
  'question' => $_POST['question'],
  'choices' => NULL,
  'correct_answer' => isset($_GET['type']) ? $_POST['correct_answer'] : NULL,
  'image' => $_FILES['image'],
  'comment' => $_POST['comment'] !== "" ? $_POST['comment'] : NULL,
];


if ($attributes['image'] && $attributes['image']['tmp_name']) {
  $attributes['image'] = uploadImage($attributes['image']);
} else {
  $attributes['image'] = NULL;
}

if ($_GET['type'] === 'multiple') {
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

$test = $db->query('SELECT * FROM tests WHERE test_id=:test_id', [
  'test_id' => $_GET['id'] ?? false
])->find();

$form = QuestionForm::validate($attributes);

if (!$test['editable']) {
  $form->error('question', 'Editing question disabled.')->throw();
}

$updateQuestion = (new UpdateQuestion)->attempt($attributes);

redirect('/single_test/editquestion?id=' . $_GET['id'] . '&tab=edit&type=' . $_GET['type'] . '&quesId=' . $_GET['quesId']);
