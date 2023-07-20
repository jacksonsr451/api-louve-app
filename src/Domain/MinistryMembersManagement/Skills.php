<?php

namespace App\Domain\MinistryMembersManagement;

use App\Domain\MinistryMembersManagement\Errors\InvalidSkill;

class Skills
{
    const GUITAR = 'Guitar';
    const VOCAL = 'Vocal';
    const DRUMS = 'Drums';
    const BASS = 'Bass';
    const KEYBOARD = 'Keyboard';

    public static function validate(array $skills): void
    {
        foreach ($skills as $skill) {
            if (!in_array($skill, [
                Skills::GUITAR,
                Skills::VOCAL,
                Skills::DRUMS,
                Skills::BASS,
                Skills::KEYBOARD
            ])) {
                throw new InvalidSkill();
            }
        }
    }
}
