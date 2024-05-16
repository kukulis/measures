<?php

namespace Gt\Measures\Domain;

class DirectDayCalculator implements IDayCalculator
{
    use DayCalculatorTrait;

    public function getDay(int $timestamp): string
    {
        $date = (new \DateTime())->setTimestamp($timestamp);
        $date->setTimezone(new \DateTimeZone($this->timeZone));

        $hourShift = $this->timestampShift / (60*60);
        $hour = $date->format('H');

        if ( $hour < $hourShift) {
            $date->add( new \DateInterval('-1 day'));
        }

        return $date->format('Y-m-d');
    }

    // TODO week
    // TODO month
}