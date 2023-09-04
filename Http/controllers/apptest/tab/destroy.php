<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('DELETE FROM test_questions WHERE id=:id', ['id' => $_GET['quesId']]);

redirect('/single_test?id=' . $_GET['id']);
