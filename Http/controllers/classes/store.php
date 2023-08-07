<?php

use Core\Auth\ClassAuth;
use Http\Form\ClassForm;

$attributes = [
  'class_name' => $_POST['class_name']
];

$form = ClassForm::validate($attributes);
$addClass = (new ClassAuth)->attempt($attributes);

if(!$addClass) {
  $form->error('class_name', "Class Already Exists.")->throw();
  redirect('/classes/create');
}

redirect('/classes');