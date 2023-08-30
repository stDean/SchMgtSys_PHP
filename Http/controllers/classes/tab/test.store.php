<?php

use Core\App;
use Core\Auth\TestAuth;
use Core\Database;
use Http\Form\TestForm;

$db = App::resolve(Database::class);

$attributes = [
  'test_name' => $_POST['test_name'],
  'disabled' => 0
];

$form = TestForm::validate($attributes);
$tests = (new TestAuth)->attempt($attributes);

if (!$tests) {
  $form->error('test_name', "Test already exist!")->throw();
}

redirect("/single_class?id={$_GET['id']}&tab=tests");
