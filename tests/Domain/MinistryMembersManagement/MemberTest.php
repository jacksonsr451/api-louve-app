<?php

namespace App\Http\Controllers;

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
        $this->assertEquals($id, $member->id);
        $this->assertEquals($name, $member->name);
        $this->assertEquals($skills, $member->skills);
        $this->assertEquals($availability, $member->availability);
    }

    public function testMemberIsReadonly()
    {
        $this->expectException(\Error::class);

        $id = '1';
        $name = 'João';
        $skills = ['Guitar', 'Vocal'];
        $availability = ['Monday', 'Wednesday', 'Friday'];

        $member = new Member($id, $name, $skills, $availability);

        $member->id = '2';
        $member->name = 'Maria';
        $member->skills[] = 'Bass';
        $member->availability[] = 'Saturday';
    }
}
