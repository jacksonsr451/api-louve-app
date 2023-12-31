<?php

namespace Tests\Domain\MusicManager;

use App\Domain\MusicManager\Song;
use PHPUnit\Framework\TestCase;

class SongTest extends TestCase
{
    public function testGetTitle()
    {
        $song = new Song('Song Title', '1', 'https://example.com', 'Song lyrics...', 'Song chords...');
        $this->assertEquals('Song Title', $song->getTitle());
    }

    public function testGetMinisterID()
    {
        $song = new Song('Song Title', '1', 'https://example.com', 'Song lyrics...', 'Song chords...');
        $this->assertEquals('1', $song->getMinisterID());
    }

    public function testGetLink()
    {
        $song = new Song('Song Title', '1', 'https://example.com', 'Song lyrics...', 'Song chords...');
        $this->assertEquals('https://example.com', $song->getLink());
    }

    public function testGetLyrics()
    {
        $song = new Song('Song Title', '1', 'https://example.com', 'Song lyrics...', 'Song chords...');
        $this->assertEquals('Song lyrics...', $song->getLyrics());
    }

    public function testGetChords()
    {
        $song = new Song('Song Title', '1', 'https://example.com', 'Song lyrics...', 'Song chords...');
        $this->assertEquals('Song chords...', $song->getChords());
    }
}
