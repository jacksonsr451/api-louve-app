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

    public function testGetters()
    {
        $id = '1';
        $name = 'João';
        $skills = ['Guitar', 'Vocal'];
        $availability = ['Monday', 'Wednesday', 'Friday'];

        $member = new Member($id, $name, $skills, $availability);

        $this->assertEquals($id, $member->getId());
        $this->assertEquals($name, $member->getName());
        $this->assertEquals($skills, $member->getSkills());
        $this->assertEquals($availability, $member->getAvailability());
    }
}
