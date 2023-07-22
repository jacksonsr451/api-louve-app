<?php

namespace App\Application\ScheduleManager\Contracts;

use App\Domain\ScheduleManager\Schedule;

interface ScheduleRepositoryInterface
{
    public function create(Schedule $schedule): void;
    public function update(Schedule $schedule): void;
    public function getAll(): array;
}
