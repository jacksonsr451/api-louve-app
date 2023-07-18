<?php

use Jacksonsr45\RadiantPHP\Http\Request;

require_once __DIR__ . '/../src/bootstrap.php';

require_once __DIR__ . '/../src/routes.php';

$router->handleRequest(new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']));
