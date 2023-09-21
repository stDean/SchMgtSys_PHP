<?php

use Core\App;
use Core\Database;
use Http\Form\QuestionForm;

$db = App::resolve(Database::class);

$attributes = [
  'question' => $_POST['question'],
  'correct_answer' => isset($_GET['type']) ? $_POST['correct_answer'] : NULL,
  'comment' => $_POST['comment'] !== "" ? $_POST['comment'] : NULL,
];

$test = $db->query('SELECT * FROM tests WHERE test_id=:test_id', [
  'test_id' => $_GET['id'] ?? false
])->find();

$form = QuestionForm::validate($attributes);
if (!$test['editable']) {
  $form->error('question', 'Deleting question disabled.')->throw();
}

$db->query('DELETE FROM test_questions WHERE id=:id', ['id' => $_GET['quesId']]);

redirect('/single_test?id=' . $_GET['id']);
