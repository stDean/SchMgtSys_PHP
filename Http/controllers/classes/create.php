<?php

use Core\Session;

view('classes/create.view.php', [
  'errors' => Session::get('errors')
]);