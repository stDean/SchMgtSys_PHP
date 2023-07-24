<?php

$router->get('/', "index.php");
$router->get('/student', "student.php");
$router->get('/profile', "profile.php");

$router->get('/login', "session/create.php");

$router->get('/register', "register/create.php");
