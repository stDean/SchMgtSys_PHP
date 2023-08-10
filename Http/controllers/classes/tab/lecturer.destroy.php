<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('DELETE FROM classes_lecturer WHERE user_id=:user_id', [
  'user_id' => $_POST['user_id']
]);

redirect("/single_class?id={$_GET['id']}&&tag=lecturer-add");
exit();
