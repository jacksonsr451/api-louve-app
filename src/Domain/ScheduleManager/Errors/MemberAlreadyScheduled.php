<?php

namespace App\Domain\ScheduleManager\Errors;

use Exception;

class MemberAlreadyScheduled extends Exception
{
    public function __construct()
    {
        $this->message = 'Member already scheduled!';
    }
}
