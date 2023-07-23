<?php

namespace App\Interfaces\Controllers;

use App\Application\MinistryMembersManagement\Contracts\MinistryMembersServiceInterface;

class MinistryMembersController
{
    private MinistryMembersServiceInterface $service;

    public function __construct(MinistryMembersServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index(): void
    {
    }

    public function showByName(): void
    {
    }

    public function showBySkills(): void
    {
    }

    public function showByAvailability(): void
    {
    }

    public function register(): void
    {
    }

    public function update(): void
    {
    }

    public function delete(): void
    {
    }
}
