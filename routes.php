<?php

$router->get('/', "index.php")->only('auth');
$router->get('/students', "student.php")->only('auth');
$router->get('/profile', "profile.php")->only('auth');
$router->get('/users', "users.php")->only('auth');

$router->get('/classes', "classes/index.php")->only('auth');
$router->get('/classes/create', "classes/create.php")->only('auth');
$router->post('/classes/store', "classes/store.php")->only('auth');
$router->get('/classes/edit', "classes/edit.php")->only('auth');
$router->patch('/classes', "classes/update.php")->only('auth');
$router->get('/classes/delete', "classes/delete.php")->only('auth');
$router->delete('/classes', "classes/destroy.php")->only('auth');
$router->get('/single_class', "classes/single_class.php")->only('auth');

$router->get('/schools', "schools/index.php")->only('auth');
$router->get('/schools/create', "schools/create.php")->only('auth');
$router->post('/schools/store', "schools/store.php")->only('auth');
$router->get('/schools/edit', "schools/edit.php")->only('auth');
$router->patch('/schools', "schools/update.php")->only('auth');
$router->get('/schools/delete', "schools/delete.php")->only('auth');
$router->delete('/schools', "schools/destroy.php")->only('auth');
$router->get('/switch_school', "schools/switch.php")->only('superAdmin');

$router->get('/login', "session/create.php")->only('guest');
$router->post('/session', "session/store.php")->only('guest');
$router->delete('/session', "session/destroy.php")->only('auth');

$router->get('/register', "register/create.php")->only('auth');
$router->post('/register', "register/store.php")->only('auth');
