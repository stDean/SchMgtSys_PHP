<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$schools = $db->query('SELECT * FROM schools')->get();

function afterSelect($data, $key)
{
  $formattedData = [];

  foreach ($data as $school) {
    $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE user_id=:user_id', [
      'user_id' => $school['user_id']
    ])->get();

    $school[$key] = is_array($user) ? $user[0] : false;
    $formattedData[] = $school;
  }

  return $formattedData;
}

$newSch = afterSelect($schools, 'user');

view('school/index.view.php', [
  'schools' => $newSch
]);
