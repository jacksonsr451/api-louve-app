<?php

namespace App\Domain\MinistryMembersManagement\Errors;

use Exception;

class MemberNotFound extends Exception
{
    public function __construct()
    {
        $this->message = 'Member not found!';
    }
}
