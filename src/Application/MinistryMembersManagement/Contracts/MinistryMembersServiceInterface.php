<?php

namespace App\Application\MinistryMembersManagement\Contracts;

use App\Application\MinistryMembersManagement\DTOs\MemberDTO;

interface MinistryMembersServiceInterface
{
    public function registerMember(MemberDTO $member): void;
    public function updateMember(MemberDTO $member): void;
    public function removeMember(MemberDTO $member): void;
    public function getAll(): array;
    public function getByName(MemberDTO $member): MemberDTO;
    public function getBySkills(MemberDTO $member): array;
    public function getByAvailability(MemberDTO $member): array;
}
