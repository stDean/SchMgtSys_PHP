<?php

use Core\Auth\RegAuth;
use Http\Form\RegForm;

$attributes = [
  'first_name' => $_POST['first_name'],
  'last_name' => $_POST['last_name'],
  'email' => $_POST['email'],
  'gender' => $_POST['gender'],
  'role' => $_POST['role'],
  'password' => $_POST['password'],
  'cfPassword' => $_POST['cfPassword']
];
$mode = str_contains('mode=student', explode("?", $_SERVER['HTTP_REFERER'])[1]) ? 'students' : 'users';
$form = RegForm::validate($attributes);
$registerUser = (new RegAuth)->attempt($attributes);
if (!$registerUser) {
  $form->error('email', "Email exists, Try again with new email.")->throw();
}

redirect($mode);
