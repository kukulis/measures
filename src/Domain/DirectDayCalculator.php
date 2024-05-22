<?php

namespace Gt\Measures\Domain;

use DateInterval;
use DateTime;
use DateTimeInterface;
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

    public function getDayKey(int $timestamp): string
    {
        return $this->getShiftedDate($timestamp)->format('Y-m-d');
    }

    public function getWeekKey(int $timestamp): string
    {
        return $this->getShiftedDate($timestamp)->format('Y-W');
    }

    public function getMonthKey(int $timestamp): string
    {
        return $this->getShiftedDate($timestamp)->format('Y-m');
    }

    public function getShiftedDate(int $timestamp): DateTimeInterface
    {
        $date = (new DateTime())->setTimestamp($timestamp);
        $date->setTimezone($this->timeZone);

        $hourShift = $this->timestampShift / (60 * 60);
        $hour = $date->format('H');

        if ($hour < $hourShift) {
            $date->add(DateInterval::createFromDateString('-1 day'));
        }

        return $date;
    }

    public function getTimeZone(): DateTimeZone
    {
        return $this->timeZone;
    }

    public function getTimestampShift(): int
    {
        return $this->timestampShift;
    }

    public function getQuarterKey(int $timestamp): string
    {
        // TODO: Implement getQuarterKey() method.
        return '';
    }


}