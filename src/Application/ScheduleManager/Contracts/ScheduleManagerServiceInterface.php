<?php

namespace App\Application\ScheduleManager\Contracts;

use App\Application\ScheduleManager\DTOs\ScheduleDTO;

interface ScheduleManagerServiceInterface
{
    public function createSchedule(ScheduleDTO $schedule): void;
    public function updateSchedule(ScheduleDTO $schedule): void;
    public function getSchedules(): array;
    public function getScheduleByEvent(ScheduleDTO $schedule): ScheduleDTO;
    public function getSchedulesByMember(ScheduleDTO $schedule): array;
}
