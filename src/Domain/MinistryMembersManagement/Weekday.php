<?php

namespace App\Domain\MinistryMembersManagement;

use App\Domain\MinistryMembersManagement\Errors\InvalidWeekday;
use Exception;

class Weekday
{
    const SUNDAY    = 'Sunday';
    const MONDAY    = 'Monday';
    const TUESDAY   = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY  = 'Thursday';
    const FRIDAY    = 'Friday';
    const SATURDAY  = 'Saturday';

    public static function validate(array $weekdays): void
    {
        foreach ($weekdays as $weekday) {
            if (!in_array($weekday, [
                Weekday::SUNDAY,
                Weekday::MONDAY,
                Weekday::TUESDAY,
                Weekday::WEDNESDAY,
                Weekday::THURSDAY,
                Weekday::FRIDAY,
                Weekday::SATURDAY
            ])) {
                throw new InvalidWeekday();
            }
        }
    }
}
