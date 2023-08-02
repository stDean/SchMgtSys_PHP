<?php

use Core\Session;

view('school/create.view.php', [
  'errors' => Session::get('errors')
]);