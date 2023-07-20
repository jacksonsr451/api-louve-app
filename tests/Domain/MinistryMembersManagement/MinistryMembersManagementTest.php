<?php

namespace Tests\Domain\MinistryMembersManagement;

use App\Domain\MinistryMembersManagement\Errors\InvalidSkill;
use App\Domain\MinistryMembersManagement\Errors\InvalidWeekday;
use App\Domain\MinistryMembersManagement\Member;
use App\Domain\MinistryMembersManagement\MinistryMembersManagement;
use App\Domain\MinistryMembersManagement\Errors\MemberAlreadyExists;
use App\Domain\MinistryMembersManagement\Errors\MemberNotFound;
use PHPUnit\Framework\TestCase;

class MinistryMembersManagementTest extends TestCase
{
    public function testAllMembers()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $allMembers = $ministryMembersManagement->allMembers();

        $this->assertCount(2, $allMembers);
        $this->assertContains($member1, $allMembers);
        $this->assertContains($member2, $allMembers);
    }

    public function testRegisterMemberSuccessfully()
    {
        $existingMembers = [];
        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $name = 'João';
        $skills = ['Guitar'];
        $availability = ['Monday', 'Wednesday'];

        $member = $ministryMembersManagement->registerMember($name, $skills, $availability);

        $this->assertEquals($name, $member->getName());
        $this->assertEquals($skills, $member->getSkills());
        $this->assertEquals($availability, $member->getAvailability());

        $this->assertCount(1, $ministryMembersManagement->allMembers());
        $this->assertContains($member, $ministryMembersManagement->allMembers());
    }

    public function testRegisterMemberThrowsExceptionForExistingMember()
    {
        $existingMembers = [
            new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']),
            new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']),
        ];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $name = 'João';
        $skills = ['Bass'];
        $availability = ['Sunday'];

        $this->expectException(MemberAlreadyExists::class);
        $ministryMembersManagement->registerMember($name, $skills, $availability);
    }

    public function testRegisterMemberWithInvalidSkills()
    {
        $existingMembers = [];
        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $name = 'Carlos';
        $skills = ['InvalidSkill'];
        $availability = ['Friday'];

        $this->expectException(InvalidSkill::class);
        $ministryMembersManagement->registerMember($name, $skills, $availability);
    }

    public function testRegisterMemberWithInvalidAvailability()
    {
        $existingMembers = [];
        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $name = 'Lucas';
        $skills = ['Guitar'];
        $availability = ['InvalidDay'];

        $this->expectException(InvalidWeekday::class);
        $ministryMembersManagement->registerMember($name, $skills, $availability);
    }

    public function testRemoveMemberSuccessfully()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        // Remove member2 with ID '2'
        $removedMember = $ministryMembersManagement->removeMember('2');

        $this->assertSame($member2, $removedMember);
        $this->assertCount(1, $ministryMembersManagement->allMembers());
        $this->assertNotContains($member2, $ministryMembersManagement->allMembers());
    }

    public function testRemoveMemberThrowsExceptionForNonExistingMember()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $existingMembers = [$member1];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $nonExistingId = '999';

        $this->expectException(MemberNotFound::class);
        $ministryMembersManagement->removeMember($nonExistingId);
    }

    public function testUpdateMemberSuccessfully()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $idToUpdate = '1';
        $newName = 'José';
        $newSkills = ['Drums'];
        $newAvailability = ['Friday'];

        $updatedMember = $ministryMembersManagement->updateMember($idToUpdate, $newName, $newSkills, $newAvailability);

        $this->assertSame($newName, $updatedMember->getName());
        $this->assertSame($newSkills, $updatedMember->getSkills());
        $this->assertSame($newAvailability, $updatedMember->getAvailability());

        $this->assertEquals($member1, $updatedMember);
    }

    public function testUpdateMemberThrowsExceptionForMemberNotFound()
    {
        $existingMembers = [];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $nonExistingId = '999';
        $newName = 'José';
        $newSkills = ['Drums'];
        $newAvailability = ['Friday'];

        $this->expectException(MemberNotFound::class);
        $ministryMembersManagement->updateMember($nonExistingId, $newName, $newSkills, $newAvailability);
    }

    public function testGetByName()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $nameToFind = 'Maria';
        $foundMember = $ministryMembersManagement->getByName($nameToFind);

        $this->assertSame($nameToFind, $foundMember->getName());
        $this->assertEquals($member2, $foundMember);
    }

    public function testGetByNameThrowsExceptionForMemberNotFound()
    {
        $existingMembers = [];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $nonExistingName = 'NonExistingName';

        $this->expectException(MemberNotFound::class);
        $ministryMembersManagement->getByName($nonExistingName);
    }

    public function testGetBySkills()
    {
        $member1 = new Member('1', 'João', ['Guitar', 'Vocal'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $skillsToFind = 'Vocal';
        $foundMembers = $ministryMembersManagement->getBySkills($skillsToFind);

        $this->assertCount(2, $foundMembers);
        $this->assertContains($member1, $foundMembers);
        $this->assertContains($member2, $foundMembers);
    }

    public function testGetBySkillsReturnsEmptyArrayForNoMatch()
    {
        $member1 = new Member('1', 'João', ['Guitar', 'Vocal'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $nonExistingSkills = 'Drums';
        $foundMembers = $ministryMembersManagement->getBySkills($nonExistingSkills);

        $this->assertEmpty($foundMembers);
    }

    public function testGetByAvailability()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $availabilityToFind = 'Tuesday';
        $foundMembers = $ministryMembersManagement->getByAvailability($availabilityToFind);

        $this->assertCount(1, $foundMembers);
        $this->assertContains($member2, $foundMembers);
    }

    public function testGetByAvailabilityReturnsEmptyArrayForNoMatch()
    {
        $member1 = new Member('1', 'João', ['Guitar'], ['Monday', 'Wednesday']);
        $member2 = new Member('2', 'Maria', ['Vocal'], ['Tuesday', 'Thursday']);
        $existingMembers = [$member1, $member2];

        $ministryMembersManagement = new MinistryMembersManagement($existingMembers);

        $nonExistingAvailability = 'Friday';
        $foundMembers = $ministryMembersManagement->getByAvailability($nonExistingAvailability);

        $this->assertEmpty($foundMembers);
    }
}
