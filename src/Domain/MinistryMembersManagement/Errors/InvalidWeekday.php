<?php

namespace App\Domain\MinistryMembersManagement\Errors;

use Exception;

class InvalidWeekday extends Exception
{
    public function __construct()
    {
        $this->message = 'Invalid weekday!';
    }
}
