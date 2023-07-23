<?php

namespace App\Application\MusicManager;

use App\Application\MusicManager\Contracts\MusicManagerServiceInterface;
use App\Application\MusicManager\Contracts\SongRepositoryInterface;
use App\Application\MusicManager\DTOs\SongDTO;
use App\Domain\MusicManager\MusicManager;

class MusicManagerService implements MusicManagerServiceInterface
{
    private SongRepositoryInterface $repository;

    public function __construct(SongRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function addMusic(SongDTO $song): void
    {
        $musicManager = new MusicManager($this->repository->getAll());
        $data = $musicManager->addSong(
            $song->title,
            $song->ministerID,
            $song->link,
            $song->lyrics,
            $song->chords
        );
        $this->repository->create($data);
    }

    public function deleteMusic(SongDTO $song): void
    {
        $musicManager = new MusicManager($this->repository->getAll());
        $data = $musicManager->deleteSong($song->title);
        $this->repository->delete($data);
    }

    public function getMusics(): array
    {
        $musicManager = new MusicManager($this->repository->getAll());
        $data = $musicManager->getSongs();
        return $this->toDTO($data);
    }

    public function getMusicByTitle(SongDTO $song): SongDTO
    {
        $musicManager = new MusicManager($this->repository->getAll());
        $data = $musicManager->getSongByTitle($song->title);
        return new SongDTO(
            $data->getTitle(),
            $data->getMinisterID(),
            $data->getLink(),
            $data->getLyrics(),
            $data->getChords()
        );
    }

    public function getMusicByMinister(SongDTO $song): array
    {
        $musicManager = new MusicManager($this->repository->getAll());
        $data = $musicManager->getSongByMinister($song->ministerID);
        return $this->toDTO($data);
    }

    private function toDTO(array $values): array
    {
        $data = [];
        foreach ($values as $value) {
            $data[] = new SongDTO(
                $value->getTitle(),
                $value->getMinisterID(),
                $value->getLink(),
                $value->getLyrics(),
                $value->getChords()
            );
        }
        return $data;
    }
}
