<?php

namespace App\Domain\MusicManager;

class Song
{
    private string $title;
    private string $ministerID;
    private string $link;
    private string $lyrics;
    private string $chords;

    public function __construct(string $title, string $ministerID, string $link, string $lyrics, string $chords)
    {
        $this->title = $title;
        $this->ministerID = $ministerID;
        $this->link = $link;
        $this->lyrics = $lyrics;
        $this->chords = $chords;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMinisterID(): string
    {
        return $this->ministerID;
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
