<?php

namespace App\Application\MusicManager;

interface MusicManagerServiceInterface
{
    public function addMusic(SongDTO $song): void;
    public function deleteMusic(SongDTO $song): void;
    public function getMusics(): array;
    public function getMusicByTitle(string $title): SongDTO;
    public function getMusicByMinister(SongDTO $song): array;
}
