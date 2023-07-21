<?php

namespace App\Domain\ScheduleManager;

use App\Domain\ScheduleManager\Errors\MemberAlreadyScheduled;
use App\Domain\ScheduleManager\Errors\MemberOverloaded;

class ScheduleManager
{
    private array $schedules = [];
    private array $membersHistory = [];

    public function __construct(array $schedules)
    {
        $this->schedules = $schedules;
    }

    public function createSchedule(string $eventId, array $membersID): Schedule
    {
        foreach ($membersID as $memberID) {
            if ($this->isMemberScheduled($eventId, $memberID)) {
                throw new MemberAlreadyScheduled();
            }

            if ($this->isMemberOverloaded($memberID)) {
                throw new MemberOverloaded();
            }
        }

        $schedule = new Schedule($eventId, $membersID);
        $this->schedules[] = $schedule;

        $this->updateMembersHistory($membersID);

        return $schedule;
    }

    public function updateSchedule(string $eventId, array $membersID): Schedule
    {
        foreach ($this->schedules as $index => $schedule) {
            if ($schedule->getEventId() === $eventId) {
                unset($this->schedules[$index]);
            }
        }

        foreach ($membersID as $memberID) {
            if ($this->isMemberScheduled($eventId, $memberID)) {
                throw new MemberAlreadyScheduled();
            }

            if ($this->isMemberOverloaded($memberID)) {
                throw new MemberOverloaded();
            }
        }

        $schedule = new Schedule($eventId, $membersID);
        $this->schedules[] = $schedule;

        $this->updateMembersHistory($membersID);

        return $schedule;
    }

    public function getSchedules(): array
    {
        return $this->schedules;
    }

    public function getSchedulesByEvent(string $eventId): array
    {
        $schedules = [];
        foreach ($this->schedules as $schedule) {
            if ($schedule->getEventId() === $eventId) {
                $schedules[] = $schedule;
            }
        }
        return $schedules;
    }

    public function getSchedulesByMember(string $memberID): array
    {
        $schedules = [];
        foreach ($this->schedules as $schedule) {
            if (in_array($memberID, $schedule->getMembers())) {
                $schedules[] = $schedule;
            }
        }
        return $schedules;
    }

    private function isMemberScheduled(string $eventId, string $memberID): bool
    {
        foreach ($this->schedules as $schedule) {
            if ($schedule->getEventId() === $eventId && in_array($memberID, $schedule->getMembers())) {
                return true;
            }
        }

        return false;
    }

    private function isMemberOverloaded(string $member): bool
    {
        $count = 0;

        foreach ($this->membersHistory as $historyMember => $occurrences) {
            if ($historyMember === $member) {
                $count = $occurrences;
                break;
            }
        }

        return $count >= 2;
    }

    private function updateMembersHistory(array $membersID): void
    {
        foreach ($membersID as $memberID) {
            if (isset($this->membersHistory[$memberID])) {
                $this->membersHistory[$memberID]++;
            } else {
                $this->membersHistory[$memberID] = 1;
            }
        }
    }
}
