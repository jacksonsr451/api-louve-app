<?php

namespace Tests\Application\ScheduleManager;

use App\Application\ScheduleManager\Contracts\ScheduleRepositoryInterface;
use App\Domain\ScheduleManager\Schedule;

class MockScheduleRepository implements ScheduleRepositoryInterface
{
    private array $schedules = [];

    public function create(Schedule $schedule): void
    {
        $this->schedules[] = $schedule;
    }

    public function update(Schedule $schedule): void
    {
        foreach ($this->schedules as $index => $value) {
            if ($value->getEventId() === $schedule->getEventId()) {
                $this->schedules[$index] = $schedule;
            }
        }
    }

    public function getAll(): array
    {
        return $this->schedules;
    }
}
