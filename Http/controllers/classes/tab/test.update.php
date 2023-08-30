<?php

use Core\App;
use Core\Database;
use Http\Form\TestForm;

$attributes = [
  'test_name' => $_POST['test_name'],
  'disabled' => $_POST['disabled']
];

$db = App::resolve(Database::class);
$form = TestForm::validate($attributes);

$db->query('UPDATE tests SET test_name=:test_name, disabled=:disabled WHERE id=:id', [
  'id' => $_POST['id'],
  'test_name' => $attributes['test_name'],
  'disabled' => $attributes['disabled']
]);

redirect("/single_class?id={$_GET['id']}&tab=tests");
