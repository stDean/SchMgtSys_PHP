<?php

use Core\App;
use Core\Database;
use Http\Form\SchoolForm;

// dd("Update School");

$attributes = [
  'schoolname' => $_POST['schoolname']
];

$db = App::resolve(Database::class);

$form = SchoolForm::validate($attributes);

$db->query('UPDATE schools SET schoolname=:schoolname WHERE id=:id', [
  'id' => $_POST['id'],
  'schoolname' => $attributes['schoolname']
]);

header('location: /schools');
die();
