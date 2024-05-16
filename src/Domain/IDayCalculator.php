<?php

namespace Gt\Measures\Domain;

interface IDayCalculator
{
    public function getTimestampShift() : int;
    public function getTimeZone() : string;

    public function getDay(int $timestamp): string;
}