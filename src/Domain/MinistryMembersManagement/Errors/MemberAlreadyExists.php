<?php

namespace App\Domain\MinistryMembersManagement\Errors;

use Exception;

class MemberAlreadyExists extends Exception
{
    public function __construct()
    {
        $this->message = 'Member already exists!';
    }
}
