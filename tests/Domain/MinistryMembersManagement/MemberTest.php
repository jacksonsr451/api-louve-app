<?php

namespace Tests\Domain\MinistryMembersManagement;

use App\Domain\MinistryMembersManagement\Member;
use PHPUnit\Framework\TestCase;

class MemberTest extends TestCase
{
    public function testCreateMember()
    {
        $id = '1';
        $name = 'João';
        $skills = ['Guitar', 'Vocal'];
        $availability = ['Monday', 'Wednesday', 'Friday'];

        $member = new Member($id, $name, $skills, $availability);

        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals($id, $member->getId());
        $this->assertEquals($name, $member->getName());
        $this->assertEquals($skills, $member->getSkills());
        $this->assertEquals($availability, $member->getAvailability());
    }

    public function testSettersAndGetters()
    {
        $id = '1';
        $name = 'João';
        $skills = ['Guitar', 'Vocal'];
        $availability = ['Monday', 'Wednesday', 'Friday'];

        $member = new Member($id, $name, $skills, $availability);

        $newId = '2';
        $newName = 'Maria';
        $newSkills = ['Bass'];
        $newAvailability = ['Saturday'];

        $member->setId($newId);
        $member->setName($newName);
        $member->setSkills($newSkills);
        $member->setAvailability($newAvailability);

        $this->assertEquals($newId, $member->getId());
        $this->assertEquals($newName, $member->getName());
        $this->assertEquals($newSkills, $member->getSkills());
        $this->assertEquals($newAvailability, $member->getAvailability());
    }
}
