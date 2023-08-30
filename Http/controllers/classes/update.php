<?php

use Core\App;
use Core\Database;
use Http\Form\ClassForm;

$attributes = [
  'class_name' => $_POST['class_name']
];

$db = App::resolve(Database::class);
$form = ClassForm::validate($attributes);

$db->query('UPDATE classes SET class_name=:class_name WHERE id=:id', [
  'id' => $_POST['id'],
  'class_name' => $attributes['class_name']
]);

redirect('/classes');
