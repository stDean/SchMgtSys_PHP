<?php

use Core\App;
use Core\Auth\UpdateProfile;
use Core\Database;
use Http\Form\ProfileForm;

$db = App::resolve(Database::class);

$attributes = [
  'first_name' => $_POST['first_name'],
  'last_name' => $_POST['last_name'],
  'email' => $_POST['email'],
  'role' => $_POST['role'],
  'password' => $_POST['password'],
  'cfPassword' => $_POST['cfPassword'],
  'user_id' => $_GET['user'],
  'image' => $_FILES['image']
];

if ($attributes['password'] === "") {
  unset($attributes['password']);
  unset($attributes['cfPassword']);
}


if ($attributes['image'] && $attributes['image']['tmp_name']) {
  $attributes['image'] = makeImagePath($attributes['image']);
} else {
  $attributes['image'] = null;
}

$userValidate = ProfileForm::validate($attributes);
$updatedUser = (new UpdateProfile)->attempt($attributes);


if (!$updatedUser) {
  $userValidate->error('email', "Something went wrong")->throw();
}

redirect("/profile?user={$attributes['user_id']}");
