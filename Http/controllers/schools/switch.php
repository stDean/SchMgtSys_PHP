<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::get('user');

$school = $db->query('SELECT * FROM schools WHERE id=:id', [
  'id' => $_GET['id']
])->findOrFail();

$updateUser = $db->query("UPDATE users SET school_id=:school_id WHERE id=:id", [
  'school_id' => $school['school_id'],
  'id' => $user['id']
]);

if ($updateUser) {
  $user['school_id'] = $school['school_id'];
  $user['school_name'] = $school['schoolname'];
  Session::put('user', $user);
  redirect('/schools');
  exit();
}
