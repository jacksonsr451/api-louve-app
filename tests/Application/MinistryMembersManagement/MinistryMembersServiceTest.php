<?php

namespace Tests\Application\MinistryMembersManagement;

use App\Application\MinistryMembersManagement\Contracts\MemberRepositoryInterface;
use App\Application\MinistryMembersManagement\DTOs\MemberDTO;
use App\Application\MinistryMembersManagement\MinistryMembersService;
use App\Domain\MinistryMembersManagement\Errors\MemberNotFound;
use PHPUnit\Framework\TestCase;

class MinistryMembersServiceTest extends TestCase
{
    private MinistryMembersService $ministryMembersService;
    private MemberRepositoryInterface $mockRepository;

    public function setUp(): void
    {
        $this->mockRepository = new MockMemberRepository();

        $this->ministryMembersService = new MinistryMembersService($this->mockRepository);
    }

    public function testRegisterMember()
    {
        $memberDTO = new MemberDTO(null, 'John Doe', ['vocal', 'guitar'], ['monday', 'friday']);

        $this->ministryMembersService->registerMember($memberDTO);
        $result = $this->ministryMembersService->getByName($memberDTO);

        $this->assertInstanceOf(MemberDTO::class, $result);
    }

    public function testUpdateMember()
    {
        $memberDTO = new MemberDTO(null, 'John Doe', ['vocal', 'guitar'], ['monday', 'friday']);
        $this->ministryMembersService->registerMember($memberDTO);
        $result = $this->ministryMembersService->getByName($memberDTO);
        $memberDTOUpdated = new MemberDTO($result->id, 'John Doe Updated', ['guitar'], ['friday']);
        $this->ministryMembersService->updateMember($memberDTOUpdated);
        $result = $this->ministryMembersService->getByName($memberDTOUpdated);

        $this->assertInstanceOf(MemberDTO::class, $result);
    }

    public function testRemoveMember()
    {
        $memberDTO = new MemberDTO(null, 'John Doe', ['vocal', 'guitar'], ['monday', 'friday']);
        $this->ministryMembersService->registerMember($memberDTO);
        $result = $this->ministryMembersService->getByName($memberDTO);
        $memberDTO = new MemberDTO($result->id, 'John Doe', ['vocal', 'guitar'], ['monday', 'friday']);
        $this->ministryMembersService->removeMember($memberDTO);

        $this->expectException(MemberNotFound::class);
        $this->ministryMembersService->getByName($memberDTO);
    }

    public function testGetAll()
    {
        $member1 = new MemberDTO(null, 'John Doe', ['vocal'], ['monday']);
        $member2 = new MemberDTO(null, 'Jane Smith', ['piano'], ['tuesday']);
        $this->ministryMembersService->registerMember($member1);
        $this->ministryMembersService->registerMember($member2);

        $result = $this->ministryMembersService->getAll();

        $this->assertCount(2, $result);
        $this->assertInstanceOf(MemberDTO::class, $result[0]);
        $this->assertInstanceOf(MemberDTO::class, $result[1]);
    }

    public function testGetByName()
    {
        $memberDTO = new MemberDTO(null, 'John Doe', ['vocal'], ['monday']);
        $this->ministryMembersService->registerMember($memberDTO);
        $result = $this->ministryMembersService->getByName($memberDTO);

        $this->assertInstanceOf(MemberDTO::class, $result);
        $this->assertEquals('John Doe', $result->name);
    }

    public function testGetBySkills()
    {
        $member1 = new MemberDTO(null, 'John Doe', ['vocal'], ['monday']);
        $member2 = new MemberDTO(null, 'Jane Smith', ['piano'], ['tuesday']);
        $this->ministryMembersService->registerMember($member1);
        $this->ministryMembersService->registerMember($member2);

        $memberDTO = new MemberDTO(null, null, ['vocal'], []);
        $result = $this->ministryMembersService->getBySkills($memberDTO);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(MemberDTO::class, $result[0]);
        $this->assertEquals('John Doe', $result[0]->name);
    }

    public function testGetByAvailability()
    {
        $member1 = new MemberDTO(null, 'John Doe', ['vocal'], ['monday']);
        $member2 = new MemberDTO(null, 'Jane Smith', ['piano'], ['tuesday']);
        $this->ministryMembersService->registerMember($member1);
        $this->ministryMembersService->registerMember($member2);

        $memberDTO = new MemberDTO(null, null, [], ['monday']);
        $result = $this->ministryMembersService->getByAvailability($memberDTO);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(MemberDTO::class, $result[0]);
        $this->assertEquals('John Doe', $result[0]->name);
    }
}
