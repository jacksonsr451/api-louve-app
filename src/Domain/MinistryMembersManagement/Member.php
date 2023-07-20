<?php

namespace App\Domain\MinistryMembersManagement;

class Member
{

    private string $id;
    private string $name;
    private array $skills;
    private array $availability;

    public function __construct(string $id, string | null $name, array | null $skills, array | null $availability)
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

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSkills(array $skills): void
    {
        $this->skills = $skills;
    }

    public function setAvailability(array $availability): void
    {
        $this->availability = $availability;
    }
}
