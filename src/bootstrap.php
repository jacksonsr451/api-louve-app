<?php

use Dotenv\Dotenv;
use Jacksonsr45\RadiantPHP\Http\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/routes.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->handleRequest(new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']));
