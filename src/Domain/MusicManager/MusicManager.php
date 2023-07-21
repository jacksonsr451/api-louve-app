<?php

namespace App\Domain\MusicManager;

use App\Domain\MusicManager\Errors\SongAlreadyExists;
use App\Domain\MusicManager\Errors\SongNotFound;

class MusicManager
{
    private array $songs;

    public function __construct(array $songs)
    {
        $this->songs = $songs;
    }

    public function getSongs(): array
    {
        return $this->songs;
    }

    public function getSongByTitle(string $title): Song
    {
        foreach ($this->songs as $song) {
            if ($song->getTitle() === $title) {
                return $song;
            }
        }
        throw new SongNotFound();
    }

    public function getSongByMinister(string $ministerID): array
    {
        $songs = [];
        foreach ($this->songs as $song) {
            if ($song->getMinisterID() === $ministerID) {
                $songs[] =  $song;
            }
        }
        return $songs;
    }

    public function addSong(string $title, string $ministerID, string $link, string $lyrics, string $chords): Song
    {
        foreach ($this->songs as $song) {
            if ($song->getTitle() === $title && $song->getMinisterID() === $ministerID) {
                throw new SongAlreadyExists();
            }
        }
        $song = new Song($title, $ministerID, $link, $lyrics, $chords);
        $this->songs[] = $song;
        return $song;
    }

    public function deleteSong(string $title): Song
    {
        foreach ($this->songs as $index => $song) {
            if ($song->getTitle() === $title) {
                unset($this->songs[$index]);
                return $song;
            }
        }
        throw new SongNotFound();
    }
}
