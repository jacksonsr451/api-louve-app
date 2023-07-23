<?php

namespace Tests\Application\MinistryMembersManagement;

use App\Application\MinistryMembersManagement\Contracts\MemberRepositoryInterface;
use App\Domain\MinistryMembersManagement\Member;

class MockMemberRepository implements MemberRepositoryInterface
{
    private $members = [];

    public function create(Member $member): void
    {
        $this->members[] = $member;
    }

    public function update(Member $member): void
    {
        foreach ($this->members as $index => $m) {
            if ($m->getId() === $member->getId()) {
                $this->members[$index] = $member;
            }
        }
    }

    public function delete(Member $member): void
    {
        foreach ($this->members as $index => $m) {
            if ($m->getId() === $member->getId()) {
                unset($this->members[$index]);
            }
        }
    }

    public function all(): array
    {
        return $this->members;
    }
}
