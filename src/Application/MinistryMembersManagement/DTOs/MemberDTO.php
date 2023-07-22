<?php

namespace App\Application\MinistryMembersManagement\DTOs;

class MemberDTO
{
    public string $id;
    public string $name;
    public array $skills;
    public array $availability;

    public function __construct(
        ?string $id,
        ?string $name,
        array $skills,
        array $availability,
    ) {
        $this->id = $id !== null ? filter_var($id, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $this->name = $name !== null ? filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $this->skills = array_map(function ($skill) {
            return ucfirst(filter_var($skill, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }, $skills);
        $this->availability = array_map(function ($day) {
            return ucfirst(filter_var($day, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }, $availability);
    }
}
