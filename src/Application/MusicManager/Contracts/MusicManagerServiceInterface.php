<?php

namespace App\Application\MusicManager\Contracts;

use App\Application\MusicManager\DTOs\SongDTO;

interface MusicManagerServiceInterface
{
    public function addMusic(SongDTO $song): void;
    public function deleteMusic(SongDTO $song): void;
    public function getMusics(): array;
    public function getMusicByTitle(SongDTO $song): SongDTO;
    public function getMusicByMinister(SongDTO $song): array;
}
