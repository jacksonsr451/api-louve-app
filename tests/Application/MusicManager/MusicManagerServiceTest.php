<?php

namespace Tests\Application\MusicManager;

use App\Application\MusicManager\Contracts\SongRepositoryInterface;
use App\Application\MusicManager\MusicManagerService;
use App\Application\MusicManager\DTOs\SongDTO;
use App\Domain\MusicManager\Errors\SongNotFound;
use PHPUnit\Framework\TestCase;

class MusicManagerServiceTest extends TestCase
{
    private MusicManagerService $musicManagerService;
    private SongRepositoryInterface $mockRepository;

    public function setUp(): void
    {
        $this->mockRepository = new MockSongRepository();
        $this->musicManagerService = new MusicManagerService($this->mockRepository);
    }

    public function testAddMusic()
    {
        $songDTO = new SongDTO(
            'Song Title',
            'Minister ID',
            'http://song-link.com',
            'http://song-lyrics.com',
            'http://song-chords.com'
        );
        $this->musicManagerService->addMusic($songDTO);

        $value = $this->musicManagerService->getMusicByTitle($songDTO);
        $this->assertInstanceOf(SongDTO::class, $value);
        $this->assertEquals('Song Title', $value->title);
    }

    public function testDeleteMusic()
    {
        $songDTO = new SongDTO(
            'Song Title',
            'Minister ID',
            'http://song-link.com',
            'http://song-lyrics.com',
            'http://song-chords.com'
        );
        $this->musicManagerService->addMusic($songDTO);

        $this->musicManagerService->deleteMusic($songDTO);

        $this->expectException(SongNotFound::class);
        $this->musicManagerService->getMusicByTitle($songDTO);
    }

    public function testGetMusics()
    {
        $songDTO = new SongDTO(
            'Song Title',
            'Minister ID',
            'http://song-link.com',
            'http://song-lyrics.com',
            'http://song-chords.com'
        );
        $this->musicManagerService->addMusic($songDTO);
        $songDTO = new SongDTO(
            'Song Title 2',
            'Minister ID 2',
            'http://song-link2.com',
            'http://song-lyrics2.com',
            'http://song-chords2.com'
        );
        $this->musicManagerService->addMusic($songDTO);

        $result = $this->musicManagerService->getMusics();

        $this->assertCount(2, $result);
        $this->assertInstanceOf(SongDTO::class, $result[0]);
        $this->assertInstanceOf(SongDTO::class, $result[1]);
    }

    public function testGetMusicByTitle()
    {
        $songDTO = new SongDTO(
            'Song Title',
            'Minister ID',
            'http://song-link.com',
            'http://song-lyrics.com',
            'http://song-chords.com'
        );
        $this->musicManagerService->addMusic($songDTO);

        $songDTO = new SongDTO('Song Title', 'Minister ID', 'song-link', 'song-lyrics', 'song-chords');
        $result = $this->musicManagerService->getMusicByTitle($songDTO);

        $this->assertInstanceOf(SongDTO::class, $result);
        $this->assertEquals('Song Title', $result->title);
    }

    public function testGetMusicByMinister()
    {
        $songDTO = new SongDTO(
            'Song Title',
            'Minister ID',
            'http://song-link.com',
            'http://song-lyrics.com',
            'http://song-chords.com'
        );
        $this->musicManagerService->addMusic($songDTO);

        $songDTO = new SongDTO(null, 'Minister ID', null, null, null);
        $result = $this->musicManagerService->getMusicByMinister($songDTO);

        $this->assertCount(1, $result);
        $this->assertInstanceOf(SongDTO::class, $result[0]);
    }
}
