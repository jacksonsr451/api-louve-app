<?php

namespace App\Application\MusicManager\DTOs;

class SongDTO
{
    public string $title;
    public string $ministerID;
    public string $link;
    public string $lyrics;
    public string $chords;

    public function __construct(
        ?string $title,
        ?string $ministerID,
        ?string $link,
        ?string $lyrics,
        ?string $chords,
    ) {
        $this->title = $title !== "" ? ucfirst(filter_var($title, FILTER_SANITIZE_FULL_SPECIAL_CHARS)) : "";
        $this->ministerID = $ministerID !== "" ? filter_var($ministerID, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "";
        $this->link = $link !== "" ? filter_var($link, FILTER_SANITIZE_URL) : "";
        $this->lyrics = $lyrics !== "" ? filter_var($lyrics, FILTER_SANITIZE_URL) : "";
        $this->chords = $chords !== "" ? filter_var($chords, FILTER_SANITIZE_URL) : "";
    }
}
