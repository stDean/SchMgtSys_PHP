<?php

$router->get('/', "index.php")->only('auth');
$router->get('/students', "student.php")->only(['auth', 'reception']);
$router->get('/users', "users.php")->only(['auth', 'admin']);

$router->get('/profile', "profile/index.php")->only(['auth']);
$router->get('/profile/edit', "profile/edit.php")->only(['auth', 'canModify']);
$router->patch('/profile/edit', "profile/update.php")->only(['auth', 'canModify']);
$router->get('/profile/delete', "profile/delete.php")->only(['auth', 'canModify']);

$router->get('/classes', "classes/index.php")->only('auth');
$router->get('/classes/create', "classes/create.php")->only(['auth', 'admin']);
$router->post('/classes/store', "classes/store.php")->only(['auth', 'admin']);
$router->get('/class/edit', "classes/edit.php")->only(['auth', 'admin']);
$router->patch('/classes', "classes/update.php")->only(['auth', 'admin']);
$router->get('/class/delete', "classes/delete.php")->only(['auth', 'admin']);
$router->delete('/classes', "classes/destroy.php")->only(['auth', 'admin']);

$router->get('/single_class', "classes/single_class.php")->only(['auth']);
$router->get('/single_class/lecturer', "classes/tab/create.php")->only(['auth', 'lectAndAbove']);
$router->post('/single_class/lecturer', "classes/tab/add.php")->only(['auth', 'lectAndAbove']);
$router->delete('/single_class', "classes/tab/destroy.php")->only(['auth', 'lectAndAbove']);
$router->get('/single_class/student', "classes/tab/create.php")->only(['auth', 'lectAndAbove']);
$router->post('/single_class/student', "classes/tab/add.php")->only(['auth', 'lectAndAbove']);
$router->get('/single_class/test', "classes/tab/create.php")->only(['auth', 'lecturer']);
$router->post('/single_class/test', "classes/tab/test.store.php")->only(['auth', 'lecturer']);
$router->patch('/single_class', "classes/tab/test.update.php")->only(['auth', 'lecturer']);
$router->delete('/single_class/test', "classes/tab/destroy.php")->only(['auth', 'lecturer']);

$router->get('/schools', "schools/index.php")->only(['auth', 'superAdmin']);
$router->get('/schools/create', "schools/create.php")->only(['auth', 'superAdmin']);
$router->post('/schools/store', "schools/store.php")->only(['auth', 'superAdmin']);
$router->get('/schools/edit', "schools/edit.php")->only(['auth', 'superAdmin']);
$router->patch('/schools', "schools/update.php")->only(['auth', 'superAdmin']);
$router->get('/schools/delete', "schools/delete.php")->only(['auth', 'superAdmin']);
$router->delete('/schools', "schools/destroy.php")->only(['auth', 'superAdmin']);
$router->get('/switch_school', "schools/switch.php")->only(['auth', 'superAdmin']);

$router->get('/tests', "apptest/index.php")->only(['auth']);
$router->get('/single_test', "apptest/single_test.php")->only(['auth', 'lectAndAbove']);
$router->get('/single_test/addquestion', "apptest/tab/add.php")->only(['auth', 'lecturer']);
$router->post('/single_test/addquestion', "apptest/tab/store.php")->only(['auth', 'lecturer']);
$router->get('/single_test/editquestion', "apptest/tab/add.php")->only(['auth', 'lecturer']);
$router->patch('/single_test/editquestion', "apptest/tab/update.php")->only(['auth', 'lecturer']);
$router->get('/single_test/deletequestion', "apptest/tab/add.php")->only(['auth', 'lecturer']);
$router->delete('/single_test/deletequestion', "apptest/tab/destroy.php")->only(['auth', 'lecturer']);
$router->get('/taketest', "apptest/take_test.php")->only(['auth']);
$router->post('/taketest', "apptest/store.answer.php")->only(['auth']);

$router->get('/mark_test', "mark/mark.php")->only(['auth', 'lecturer']);
$router->get('/mark', "mark/mark_test.php")->only(['auth', 'lecturer']);
$router->post('/mark', "mark/mark_single_test.php")->only(['auth', 'lecturer']);
$router->get('/marked_tests', "mark/marked.php")->only(['auth', 'lectAndAbove']);
$router->get('/mark_view', "mark/mark_view.php")->only(['auth']);


$router->get('/login', "session/create.php")->only('guest');
$router->post('/session', "session/store.php")->only('guest');
$router->delete('/session', "session/destroy.php")->only('auth');
$router->get('/logout', "session/destroy.php")->only('auth');

$router->get('/register', "register/create.php")->only(['auth', 'receptionAndAdmin']);
$router->post('/register', "register/store.php")->only(['auth', 'receptionAndAdmin']);
