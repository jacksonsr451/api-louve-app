<?php

namespace Tests\Domain\ScheduleManager;

use App\Domain\ScheduleManager\Schedule;
use PHPUnit\Framework\TestCase;

class ScheduleTest extends TestCase
{
    public function testGetEventId()
    {
        $eventId = 'event-1';
        $membersID = ['member-1', 'member-2'];
        $schedule = new Schedule($eventId, $membersID);

        $this->assertEquals($eventId, $schedule->getEventId());
    }

    public function testGetMembers()
    {
        $eventId = 'event-1';
        $membersID = ['member-1', 'member-2'];
        $schedule = new Schedule($eventId, $membersID);

        $this->assertEquals($membersID, $schedule->getMembers());
    }
}
