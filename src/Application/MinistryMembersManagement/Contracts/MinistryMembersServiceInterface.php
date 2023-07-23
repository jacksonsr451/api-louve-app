<?php

namespace App\Application\MinistryMembersManagement\Contracts;

use App\Application\MinistryMembersManagement\DTOs\MemberDTO;
use App\Application\Service;

interface MinistryMembersServiceInterface extends Service
{
    public function registerMember(MemberDTO $member): void;
    public function updateMember(MemberDTO $member): void;
    public function removeMember(MemberDTO $member): void;
    public function getAll(): array;
    public function getByName(MemberDTO $member): MemberDTO;
    public function getBySkills(MemberDTO $member): array;
    public function getByAvailability(MemberDTO $member): array;
}
