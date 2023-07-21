<?php

namespace App\Domain\MusicManager\Errors;

use Exception;

class SongAlreadyExists extends Exception
{
    public function __construct()
    {
        $this->message = 'Song already exists!';
    }
}
