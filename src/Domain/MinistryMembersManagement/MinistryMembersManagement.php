<?php

namespace App\Domain\MinistryMembersManagement;

use App\Domain\MinistryMembersManagement\Errors\MemberAlreadyExists;
use App\Domain\MinistryMembersManagement\Errors\MemberNotFound;

class MinistryMembersManagement
{
    private array $members;

    public function __construct(array $members)
    {
        $this->members = $members;
    }

    public function allMembers(): array
    {
        return $this->members;
    }

    public function registerMember(string $name, array $skills, array $availability): Member
    {
        foreach ($this->members as $m) {
            if ($m->getName() === $name) {
                throw new MemberAlreadyExists();
            }
        }
        Weekday::validate($availability);
        Skills::validate($skills);
        $member = new Member($this->getId(), $name, $skills, $availability);
        $this->members[] = $member;
        return $member;
    }

    public function removeMember(string $id): Member
    {
        foreach ($this->members as $index => $member) {
            if ($member->getId() === $id) {
                unset($this->members[$index]);
                return $member;
            }
        }
        throw new MemberNotFound();
    }

    public function updateMember(string $id, string $name, array $skills, array $availability): Member
    {
        foreach ($this->members as $m) {
            if ($m->getName() === $name) {
                throw new MemberAlreadyExists();
            }
        }

        Weekday::validate($availability);
        Skills::validate($skills);

        foreach ($this->members as $member) {
            if ($member->getId() === $id) {
                $member->setName($name);
                $member->setSkills($skills);
                $member->setAvailability($availability);
                return $member;
            }
        }

        throw new MemberNotFound();
    }

    public function getByName(string $name): Member
    {
        foreach ($this->members as $member) {
            if ($member->getName() === $name) {
                return $member;
            }
        }
        throw new MemberNotFound();
    }

    public function getBySkills(string $skills): array
    {
        $members = [];
        foreach ($this->members as $member) {
            if (in_array($skills, $member->getSkills())) {
                $members[] = $member;
            }
        }
        return $members;
    }

    public function getByAvailability(string $availability): array
    {
        $members = [];
        foreach ($this->members as $member) {
            if (in_array($availability, $member->getAvailability())) {
                $members[] = $member;
            }
        }
        return $members;
    }

    private function getId(): string
    {
        return uniqid();
    }
}
