<?php

namespace App\Application;

abstract class Service
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
}
