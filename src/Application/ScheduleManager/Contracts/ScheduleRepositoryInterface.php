<?php

namespace App\Application\ScheduleManager\Contracts;

use App\Application\Repository;
use App\Domain\ScheduleManager\Schedule;

interface ScheduleRepositoryInterface extends Repository
{
    public function create(Schedule $schedule): void;
    public function update(Schedule $schedule): void;
    public function getAll(): array;
}
