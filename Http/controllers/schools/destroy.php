<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('DELETE FROM schools WHERE id=:id', [
  'id' => $_POST['id']
]);

header('location: /schools');
exit();
