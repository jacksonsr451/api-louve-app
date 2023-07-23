<?php

namespace App\Interfaces;

use App\Application\Service;
use Jacksonsr45\RadiantPHP\Http\Controllers;
use Jacksonsr45\RadiantPHP\Http\Request;
use Jacksonsr45\RadiantPHP\Http\Response;

abstract class Controller extends Controllers
{
    protected $service;

    public function __construct(Request $request, Response $response, Service $service)
    {
        parent::__construct($request, $response);
        $this->service = $service;
    }
}
