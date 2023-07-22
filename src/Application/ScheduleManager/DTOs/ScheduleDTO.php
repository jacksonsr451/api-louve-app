<?php

namespace App\Application\ScheduleManager\DTOs;

class ScheduleDTO
{
    public string $eventID;
    public array $membersIDs;

    public function __construct(?string $eventID, array $membersIDs)
    {
        $this->eventID = $eventID !== null ? filter_var($eventID, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
        $this->membersIDs = array_map(function ($memberID) {
            return filter_var($memberID, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }, $membersIDs);
    }
}
