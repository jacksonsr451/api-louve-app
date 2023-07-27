<?php

namespace Tests\Interfaces\MinistryMembersManagement;

use App\Application\MinistryMembersManagement\Contracts\MinistryMembersServiceInterface;
use App\Application\MinistryMembersManagement\DTOs\MemberDTO;

class MockMinistryMembersService implements MinistryMembersServiceInterface
{
    private array $members = [];

    public function registerMember(MemberDTO $member): void
    {
        $this->members[] = $member;
    }

    public function updateMember(MemberDTO $member): void
    {
        foreach ($this->members as $index => $value) {
            if ($value->id === $member->id) {
                $this->members[$index] = $member;
            }
        }
    }

    public function removeMember(MemberDTO $member): void
    {
        foreach ($this->members as $index => $value) {
            if ($value->id === $member->id) {
                unset($this->members[$index]);
            }
        }
    }

    public function getAll(): array
    {
        return $this->members;
    }

    public function getByName(MemberDTO $member): MemberDTO
    {
        foreach ($this->members as $value) {
            if ($value->name === $member->name) {
                return $value;
            }
        }
    }

    public function getBySkills(MemberDTO $member): array
    {
        $members = [];
        foreach ($this->members as $value) {
            if (in_array($member->skills[0], $value->skills)) {
                $members[] = $value;
            }
        }
        return $members;
    }

    public function getByAvailability(MemberDTO $member): array
    {
        $members = [];
        foreach ($this->members as $value) {
            if (in_array($member->availability[0], $value->availability)) {
                $members[] = $value;
            }
        }
        return $members;
    }
}
