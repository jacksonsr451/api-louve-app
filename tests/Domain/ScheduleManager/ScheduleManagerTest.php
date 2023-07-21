<?php

namespace Tests\Domain\ScheduleManager;

use App\Domain\ScheduleManager\Schedule;
use App\Domain\ScheduleManager\ScheduleManager;
use App\Domain\ScheduleManager\Errors\MemberAlreadyScheduled;
use PHPUnit\Framework\TestCase;

class ScheduleManagerTest extends TestCase
{
    private ScheduleManager $scheduleManager;

    public function setUp(): void
    {
        $this->scheduleManager = new ScheduleManager(
            [
                new Schedule('event-1', ['member-1', 'member-2']),
                new Schedule('event-2', ['member-3', 'member-4']),
            ]
        );
    }

    public function testCreateSchedule()
    {
        $eventId = 'event-3';
        $membersID = ['member-5', 'member-6'];

        $schedule = $this->scheduleManager->createSchedule($eventId, $membersID);

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertEquals($eventId, $schedule->getEventId());
        $this->assertEquals($membersID, $schedule->getMembers());

        $this->expectException(MemberAlreadyScheduled::class);
        $this->scheduleManager->createSchedule($eventId, $membersID);
    }

    public function testUpdateSchedule()
    {
        $eventId = 'event-1';
        $membersID = ['member-1', 'member-5'];

        $this->scheduleManager->updateSchedule($eventId, $membersID);
        $schedule = $this->scheduleManager->getSchedulesByEvent($eventId);
        $this->assertEquals($membersID, $schedule[0]->getMembers());
        $this->assertEquals($membersID, $schedule[0]->getMembers());
        $this->assertCount(1, $schedule);
    }

    public function testGetSchedules()
    {
        $eventId1 = 'event-1';
        $eventId2 = 'event-2';

        $schedules = $this->scheduleManager->getSchedules();

        $this->assertCount(2, $schedules);
        $this->assertEquals($eventId1, $schedules[0]->getEventId());
        $this->assertEquals($eventId2, $schedules[1]->getEventId());
    }

    public function testGetSchedulesByEvent()
    {
        $eventId1 = 'event-1';

        $schedulesByEvent = $this->scheduleManager->getSchedulesByEvent($eventId1);

        $this->assertCount(1, $schedulesByEvent);
        $this->assertEquals($eventId1, $schedulesByEvent[0]->getEventId());
    }

    public function testGetSchedulesByMember()
    {
        $eventId1 = 'event-1';

        $schedulesByMember = $this->scheduleManager->getSchedulesByMember('member-1');

        $this->assertCount(1, $schedulesByMember);
        $this->assertEquals($eventId1, $schedulesByMember[0]->getEventId());
    }

    public function testMemberAlreadyScheduled()
    {
        $eventId = 'event-1';
        $membersID = ['member-1', 'member-2'];

        $this->expectException(MemberAlreadyScheduled::class);
        $this->scheduleManager->createSchedule($eventId, $membersID);
    }
}
