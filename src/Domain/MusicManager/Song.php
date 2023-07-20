<?php

namespace App\Domain\MusicManager;

class Song
{
    private string $title;
    private string $link;
    private string $lyrics;
    private string $chords;

    public function __construct(string $title, string $link, string $lyrics, string $chords)
    {
        $this->title = $title;
        $this->link = $link;
        $this->lyrics = $lyrics;
        $this->chords = $chords;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getLyrics(): string
    {
        return $this->lyrics;
    }

    public function getChords(): string
    {
        return $this->chords;
    }
}
