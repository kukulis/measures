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
    public function getDayKey(int $timestamp): string
    {
        $date = $this->getShiftedDate($timestamp);

        return $date->format('Y-m-d');
    }


    public function getWeekKey(int $timestamp): string
    {
        $date = $this->getShiftedDate($timestamp);

        return $date->format('Y-W');
    }

    public function getMonthKey(int $timestamp): string
    {
        $date = $this->getShiftedDate($timestamp);

        return $date->format('Y-m');
    }

    public function getShiftedDate(int $timestamp) : Carbon {
        return Carbon::createFromTimestamp( $timestamp-$this->timestampShift, $this->timeZone );
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