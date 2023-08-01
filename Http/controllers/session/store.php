<?php

use Core\Auth\LoginAuth;
use Http\Form\LoginForm;

$attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password'],
];

$form = LoginForm::validate($attributes);
$signedIn = (new LoginAuth)->attempt($attributes);

if (!$signedIn) {
  $form->error('email', "Wrong credentials, Try again.")->throw();
}

redirect('/');
