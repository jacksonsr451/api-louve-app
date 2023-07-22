<?php

namespace App\Application\MusicManager;

use App\Domain\MusicManager\Song;

interface SongInterface
{
    public function create(Song $song): void;
    public function delete(Song $song): void;
    public function getAll(): array;
}
