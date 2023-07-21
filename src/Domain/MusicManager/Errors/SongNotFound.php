<?php

namespace App\Domain\MusicManager\Errors;

use Exception;

class SongNotFound extends Exception
{
    public function __construct()
    {
        $this->message = 'Song not found!';
    }
}
