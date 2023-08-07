<?php

use Core\Session;

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'users';

view('register/create.view.php', [
  'errors' => Session::get('errors'),
  'mode' => $mode
]);
