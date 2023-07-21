<?php

namespace App\Domain\ScheduleManager\Errors;

use Exception;

class MemberOverloaded extends Exception
{
    public function __construct()
    {
        $this->message = 'Member is overloaded!';
    }
}
