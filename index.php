<?php

header("Content-Type: application/json; charset=UTF-8");

include "app\Routes\Routes.php";

use app\Routes\Routes;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = new Routes();
$routes->handle($method, $path);