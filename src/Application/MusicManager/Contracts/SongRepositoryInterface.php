<?php

namespace App\Application\MusicManager\Contracts;

use App\Domain\MusicManager\Song;

interface SongRepositoryInterface
{
    public function create(Song $song): void;
    public function delete(Song $song): void;
    public function getAll(): array;
}
