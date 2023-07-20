<?php

namespace App\Domain\MinistryMembersManagement;

class Member
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly array $skills,
        public readonly array $availability,
    ) {
    }
}
