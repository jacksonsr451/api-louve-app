<?php

namespace App\Domain\ScheduleManager;

class Schedule
{
    private string $eventId;
    private array $membersID;

    public function __construct(string $eventId, array $membersID)
    {
        $this->eventId = $eventId;
        $this->membersID = $membersID;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getMembers(): array
    {
        return $this->membersID;
    }
}
