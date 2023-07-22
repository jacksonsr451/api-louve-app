<?php

namespace Tests\Application\ScheduleManager;

use App\Application\ScheduleManager\Contracts\ScheduleRepositoryInterface;
use App\Application\ScheduleManager\DTOs\ScheduleDTO;
use App\Application\ScheduleManager\ScheduleManagerService;
use PHPUnit\Framework\TestCase;

class ScheduleManagerServiceTest extends TestCase
{
    private ScheduleRepositoryInterface $mockRepository;
    private ScheduleManagerService $scheduleManagerService;

    public function setUp(): void
    {
        $this->mockRepository = new MockScheduleRepository();
        $this->scheduleManagerService = new ScheduleManagerService($this->mockRepository);
    }

    public function testCreateSchedule()
    {
        $scheduleDTO = new ScheduleDTO('event-1', ['member-1', 'member-2']);
        $this->scheduleManagerService->createSchedule($scheduleDTO);

        $data = $this->scheduleManagerService->getSchedulesByMember($scheduleDTO);
        $this->assertContainsOnlyInstancesOf(ScheduleDTO::class, $data);
        $this->assertEquals($scheduleDTO->eventID, $data[0]->eventID);
    }

    public function testGetSchedules()
    {
        $scheduleDTO = new ScheduleDTO('event-1', ['member-1', 'member-2']);
        $this->scheduleManagerService->createSchedule($scheduleDTO);
        $scheduleDTO = new ScheduleDTO('event-3', ['member-4', 'member-5']);
        $this->scheduleManagerService->createSchedule($scheduleDTO);

        $schedules = $this->scheduleManagerService->getSchedules();

        $this->assertEquals('event-1', $schedules[0]->eventID);
        $this->assertEquals(['member-1', 'member-2'], $schedules[0]->membersIDs);
        $this->assertEquals('event-3', $schedules[1]->eventID);
        $this->assertEquals(['member-4', 'member-5'], $schedules[1]->membersIDs);
    }

    public function testUpdateSchedule()
    {
        $scheduleDTO = new ScheduleDTO('event-1', ['member-1', 'member-2']);
        $this->scheduleManagerService->createSchedule($scheduleDTO);

        $scheduleDTO = new ScheduleDTO('event-1', ['member-1', 'member-2', 'member-3']);
        $this->scheduleManagerService->updateSchedule($scheduleDTO);
        $schedules = $this->scheduleManagerService->getSchedules();

        $this->assertEquals('event-1', $schedules[0]->eventID);
        $this->assertEquals(['member-1', 'member-2', 'member-3'], $schedules[0]->membersIDs);
    }

    public function testGetScheduleByEvent()
    {
        $scheduleDTO1 = new ScheduleDTO('event-1', ['member-1', 'member-2']);
        $this->scheduleManagerService->createSchedule($scheduleDTO1);
        $scheduleDTO2 = new ScheduleDTO('event-3', ['member-4', 'member-5']);
        $this->scheduleManagerService->createSchedule($scheduleDTO2);

        $schedules = $this->scheduleManagerService->getScheduleByEvent($scheduleDTO1);

        $this->assertEquals('event-1', $schedules->eventID);
        $this->assertEquals(['member-1', 'member-2'], $schedules->membersIDs);
    }

    public function testGetSchedulesByMember()
    {
        $scheduleDTO1 = new ScheduleDTO('event-1', ['member-1', 'member-2']);
        $this->scheduleManagerService->createSchedule($scheduleDTO1);
        $scheduleDTO2 = new ScheduleDTO('event-3', ['member-4', 'member-5']);
        $this->scheduleManagerService->createSchedule($scheduleDTO2);

        $schedules = $this->scheduleManagerService->getSchedulesByMember($scheduleDTO1);

        $this->assertCount(1, $schedules);
        $this->assertEquals('event-1', $schedules[0]->eventID);
        $this->assertEquals(['member-1', 'member-2'], $schedules[0]->membersIDs);
    }
}
