<?php

namespace Gt\Measures\Domain;

use Carbon\Carbon;
use DateInterval;
use DateTime;
use DateTimeZone;

class DirectDayCalculator implements IDayCalculator
{
    protected DateTimeZone $timeZone;
    protected int $timestampShift;

    public function __construct(DateTimeZone $timezone, int $timestampShift)
    {
        $this->timeZone = $timezone;
        $this->timestampShift = $timestampShift;
    }

    public function getDayCarbon(int $timestamp): string
    {
        $date = Carbon::createFromTimestamp($timestamp, $this->timeZone);

        $hourShift = $this->timestampShift / (60 * 60);
        $hour = $date->format('H');
        if ($hour < $hourShift) {
            $date->add(DateInterval::createFromDateString('-1 day')); // prepare interval in constructor
        }

        return $date->format('Y-m-d');
    }

    public function getDay(int $timestamp): string
    {
        $date = (new DateTime())->setTimestamp($timestamp);
        $date->setTimezone($this->timeZone);

        $hourShift = $this->timestampShift / (60 * 60);
        $hour = $date->format('H');

        if ($hour < $hourShift) {
            $date->add(DateInterval::createFromDateString('-1 day')); // prepare interval in constructor
        }

        // format doesn't take correct timezone
        return $date->format('Y-m-d');
    }



    public function getTimeZone(): DateTimeZone
    {
        return $this->timeZone;
    }

    public function getTimestampShift(): int
    {
        return $this->timestampShift;
    }

    // TODO week
    // TODO month


}