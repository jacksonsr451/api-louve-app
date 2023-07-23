<?php

namespace App\Application\ScheduleManager;

use App\Application\ScheduleManager\Contracts\ScheduleManagerServiceInterface;
use App\Application\ScheduleManager\Contracts\ScheduleRepositoryInterface;
use App\Application\ScheduleManager\DTOs\ScheduleDTO;
use App\Application\Service;
use App\Domain\ScheduleManager\ScheduleManager;

class ScheduleManagerService extends Service implements ScheduleManagerServiceInterface
{
    private ScheduleRepositoryInterface $repository;

    public function __construct(ScheduleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createSchedule(ScheduleDTO $schedule): void
    {
        $scheduleManager = new ScheduleManager($this->repository->getAll());
        $data = $scheduleManager->createSchedule($schedule->eventID, $schedule->membersIDs);
        $this->repository->create($data);
    }

    public function updateSchedule(ScheduleDTO $schedule): void
    {
        $scheduleManager = new ScheduleManager($this->repository->getAll());
        $data = $scheduleManager->updateSchedule($schedule->eventID, $schedule->membersIDs);
        $this->repository->update($data);
    }

    public function getSchedules(): array
    {
        $scheduleManager = new ScheduleManager($this->repository->getAll());
        $data = $scheduleManager->getSchedules();
        return $this->toDTO($data);
    }


    public function getScheduleByEvent(ScheduleDTO $schedule): ScheduleDTO
    {
        $scheduleManager = new ScheduleManager($this->repository->getAll());
        $data = $scheduleManager->getSchedulesByEvent($schedule->eventID);
        return new ScheduleDTO($data->getEventId(), $data->getMembers());
    }

    public function getSchedulesByMember(ScheduleDTO $schedule): array
    {
        $scheduleManager = new ScheduleManager($this->repository->getAll());
        $data = $scheduleManager->getSchedulesByMember($schedule->membersIDs[0]);
        return $this->toDTO($data);
    }

    private function toDTO(array $values): array
    {
        $data = [];
        foreach ($values as $value) {
            $data[] = new ScheduleDTO(
                $value->getEventId(),
                $value->getMembers()
            );
        }
        return $data;
    }
}
