<?php

namespace Tests\Application\MusicManager;

use App\Application\MusicManager\Contracts\SongRepositoryInterface;
use App\Application\Repository;
use App\Domain\MusicManager\Song;

class MockSongRepository extends Repository implements SongRepositoryInterface
{
    private array $songs = [];

    public function create(Song $song): void
    {
        $this->songs[] = $song;
    }

    public function delete(Song $song): void
    {
        foreach ($this->songs as $index => $value) {
            if ($value->getTitle() === $song->getTitle()) {
                unset($this->songs[$index]);
            }
        }
    }

    public function getAll(): array
    {
        return $this->songs;
    }
}
