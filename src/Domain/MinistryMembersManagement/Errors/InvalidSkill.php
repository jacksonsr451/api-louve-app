<?php

namespace App\Domain\MinistryMembersManagement\Errors;

use Exception;

class InvalidSkill extends Exception
{
    public function __construct()
    {
        $this->message = 'Invalid skill!';
    }
}
