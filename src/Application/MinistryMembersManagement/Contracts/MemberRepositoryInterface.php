<?php

namespace App\Application\MinistryMembersManagement\Contracts;

use App\Domain\MinistryMembersManagement\Member;

interface MemberRepositoryInterface
{
    public function create(Member $member): void;
    public function update(Member $member): void;
    public function delete(Member $member): void;
    public function all(): array;
}
