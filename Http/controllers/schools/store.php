<?php

// dd($_POST);

use Core\Auth\SchoolAuth;
use Http\Form\SchoolForm;

$attributes = [
  'schoolname' => $_POST['schoolname']
];

$form = SchoolForm::validate($attributes);
$addSchool = (new SchoolAuth)->attempt($attributes);

if(!$addSchool) {
  $form->error('schoolname', "School Already Exists.")->throw();
  redirect('/schools/create');
}

redirect('/schools');