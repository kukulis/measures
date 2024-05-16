<?php

namespace Gt\Measures\Domain;

trait DayCalculatorTrait
{
    protected string $timeZone;
    protected int $timestampShift;

    /**
     * @param string $timeZone
     * @param int $timestampShift
     */
    public function __construct(string $timeZone, int $timestampShift)
    {
        $this->timeZone = $timeZone;
        $this->timestampShift = $timestampShift;
    }

    public function getTimestampShift(): int
    {
        return $this->timestampShift;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }
}