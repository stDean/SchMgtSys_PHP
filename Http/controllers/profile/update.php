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
  $imagePath = 'uploads/' . $attributes['image']['name'];
  if ($attributes['image']['type'] === 'image/jpeg' || $attributes['image']['type'] === 'image/jpeg') {
    if (!file_exists($imagePath)) {
      mkdir(dirname(__DIR__ . '/../../../public/' . $imagePath), 0777, true);
    }

    move_uploaded_file($attributes['image']['tmp_name'], __DIR__ . '/../../../public/' . $imagePath);
  }
  $attributes['image'] = $imagePath;
} else {
  $attributes['image'] = null;
}

$userValidate = ProfileForm::validate($attributes);
$updatedUser = (new UpdateProfile)->attempt($attributes);


if (!$updatedUser) {
  $userValidate->error('email', "Something went wrong")->throw();
}

redirect("/profile?user={$attributes['user_id']}");
