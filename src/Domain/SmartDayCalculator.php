<?php

namespace Gt\Measures\Domain;

class SmartDayCalculator implements IDayCalculator
{
    use DayCalculatorTrait;

    public function getDay(int $timestamp): string
    {
        // TODO: Implement getDay() method.
    }
}