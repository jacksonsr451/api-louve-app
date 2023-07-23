<?php

namespace App\Application\MinistryMembersManagement;

use App\Application\MinistryMembersManagement\Contracts\MemberRepositoryInterface;
use App\Application\MinistryMembersManagement\Contracts\MinistryMembersServiceInterface;
use App\Application\MinistryMembersManagement\DTOs\MemberDTO;
use App\Domain\MinistryMembersManagement\MinistryMembersManagement;

class MinistryMembersService implements MinistryMembersServiceInterface
{
    private MemberRepositoryInterface $repository;

    public function __construct(MemberRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function registerMember(MemberDTO $member): void
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->registerMember(
            $member->name,
            $member->skills,
            $member->availability
        );
        $this->repository->create($data);
    }

    public function updateMember(MemberDTO $member): void
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->updateMember(
            $member->id,
            $member->name,
            $member->skills,
            $member->availability
        );
        $this->repository->update($data);
    }

    public function removeMember(MemberDTO $member): void
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->removeMember($member->id);
        $this->repository->delete($data);
    }

    public function getAll(): array
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->allMembers();
        return $this->toDTO($data);
    }

    public function getByName(MemberDTO $member): MemberDTO
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->getByName($member->name);

        return new MemberDTO(
            $data->getId(),
            $data->getName(),
            $data->getSkills(),
            $data->getAvailability()
        );
    }

    public function getBySkills(MemberDTO $member): array
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->getBySkills($member->skills[0]);
        return $this->toDTO($data);
    }

    public function getByAvailability(MemberDTO $member): array
    {
        $ministryManagement = new MinistryMembersManagement($this->repository->all());
        $data = $ministryManagement->getByAvailability($member->availability[0]);
        return $this->toDTO($data);
    }

    private function toDTO(array $values): array
    {
        $data = [];
        foreach ($values as $value) {
            $data[] = new MemberDTO(
                $value->getId(),
                $value->getName(),
                $value->getSkills(),
                $value->getAvailability()
            );
        }
        return $data;
    }
}
