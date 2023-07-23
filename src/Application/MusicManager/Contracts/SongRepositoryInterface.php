<?php

namespace App\Application\MusicManager\Contracts;

use App\Application\Repository;
use App\Domain\MusicManager\Song;

interface SongRepositoryInterface extends Repository
{
    public function create(Song $song): void;
    public function delete(Song $song): void;
    public function getAll(): array;
}
