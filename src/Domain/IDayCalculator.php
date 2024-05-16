<?php

namespace Gt\Measures\Domain;

use DateTimeZone;

interface IDayCalculator
{
    public function getTimestampShift() : int;
    public function getTimeZone() : DateTimeZone;

    public function getDay(int $timestamp): string;
}