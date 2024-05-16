<?php

namespace Gt\Measures\Domain;

use Carbon\Carbon;
use DateTimeZone;

class SmartDayCalculator implements IDayCalculator
{

    protected DateTimeZone $timeZone;
    protected int $timestampShift;

    public function __construct(DateTimeZone $timeZone, int $timestampShift)
    {
        $this->timeZone = $timeZone;
        $this->timestampShift = $timestampShift;
    }

    /**
     * simply lets remove shift from timestamp, before transforming to date object
     */
    public function getDay(int $timestamp): string
    {
        $date = Carbon::createFromTimestamp( $timestamp-$this->timestampShift, $this->timeZone );

        return $date->format('Y-m-d');
    }

    public function getTimestampShift(): int
    {
        return $this->timestampShift;
    }

    public function getTimeZone(): DateTimeZone
    {
        return $this->timeZone;
    }
}