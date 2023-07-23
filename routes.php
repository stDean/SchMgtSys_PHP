<?php

$router->get('/', "index.php");

$router->get('/login', "session/create.php");

$router->get('/register', "register/create.php");
$router->get('/student', "student.php");
