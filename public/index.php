<?php

use Core\Router;
use Core\Session;
use Core\ValidationException;

session_start();

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . "Core/functions.php";

require base_path('bootstrap.php');

$router = new Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
  $router->route($uri, $method);
} catch (ValidationException $e) {
  Session::flash('errors', $e->errors);
  Session::flash('old', $e->old);

  return redirect($router->previousUrl());
}

Session::unFlash();
