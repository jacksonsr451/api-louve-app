<?php

namespace Tests\Domain\MusicManager;

use App\Domain\MusicManager\Errors\SongAlreadyExists;
use App\Domain\MusicManager\Errors\SongNotFound;
use App\Domain\MusicManager\MusicManager;
use App\Domain\MusicManager\Song;
use PHPUnit\Framework\TestCase;

class MusicManagerTest extends TestCase
{
    private array $songs = [];

    public function setUp(): void
    {
        $this->songs = [
            new Song('Song Title 1', 'Minister1', 'https://example.com/1', 'Lyrics 1', 'Chords 1'),
            new Song('Song Title 2', 'Minister2', 'https://example.com/2', 'Lyrics 2', 'Chords 2'),
        ];
    }

    public function testGetSongs()
    {
        $musicManager = new MusicManager($this->songs);

        $this->assertSame($this->songs, $musicManager->getSongs());
    }

    public function testGetSongByTitle()
    {
        $musicManager = new MusicManager($this->songs);

        $song = $musicManager->getSongByTitle('Song Title 1');

        $this->assertEquals('Song Title 1', $song->getTitle());
        $this->assertEquals('Minister1', $song->getMinisterID());
    }

    public function testGetSongByTitleThrowsExceptionWhenNotFound()
    {
        $musicManager = new MusicManager($this->songs);

        $this->expectException(SongNotFound::class);

        $musicManager->getSongByTitle('Non-existent Song');
    }

    public function testGetSongByMinister()
    {
        $musicManager = new MusicManager($this->songs);

        $songsByMinister = $musicManager->getSongByMinister('Minister2');

        $this->assertCount(1, $songsByMinister);
        $this->assertEquals('Song Title 2', $songsByMinister[0]->getTitle());
    }

    public function testAddSong()
    {
        $musicManager = new MusicManager($this->songs);

        $newSong = $musicManager->addSong(
            'New Song',
            'Minister3',
            'https://example.com/new',
            'New Lyrics',
            'New Chords'
        );

        $this->assertSame($newSong, $musicManager->getSongByTitle('New Song'));
    }

    public function testAddSongThrowsExceptionWhenAlreadyExists()
    {
        $musicManager = new MusicManager($this->songs);

        $this->expectException(SongAlreadyExists::class);

        $musicManager->addSong(
            'Song Title 1',
            'Minister1',
            'https://example.com/1',
            'Lyrics 1',
            'Chords 1'
        );
    }

    public function testDeleteSong()
    {
        $musicManager = new MusicManager($this->songs);

        $deletedSong = $musicManager->deleteSong('Song Title 1');

        $this->assertEquals('Song Title 1', $deletedSong->getTitle());
        $this->assertCount(1, $musicManager->getSongs());
    }

    public function testDeleteSongThrowsExceptionWhenNotFound()
    {
        $musicManager = new MusicManager($this->songs);

        $this->expectException(SongNotFound::class);

        $musicManager->deleteSong('Non-existent Song');
    }
}
