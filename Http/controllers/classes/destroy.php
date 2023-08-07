<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('DELETE FROM classes WHERE id=:id', [
  'id' => $_POST['id']
]);

header('location: /classes');
exit();
