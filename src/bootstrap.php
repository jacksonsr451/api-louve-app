<?php

use Dotenv\Dotenv;
use Jacksonsr45\RadiantPHP\ServerRequestFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$pathToRoute = __DIR__ . '/routes.php';
$request = ServerRequestFactory::createServerRequest($pathToRoute);
$response = ServerRequestFactory::handleRequest($request);
ServerRequestFactory::sendHttpResponse($response);
