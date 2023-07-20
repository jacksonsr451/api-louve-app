<?php

namespace App\Domain\MinistryMembersManagement;

class Member
{

    private string $id;
    private string $name;
    private array $skills;
    private array $availability;

    public function __construct(string $id, string $name, array $skills, array $availability)
    {
        $this->id = $id;
        $this->name = $name;
        $this->skills = $skills;
        $this->availability = $availability;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function getAvailability(): array
    {
        return $this->availability;
    }
}
