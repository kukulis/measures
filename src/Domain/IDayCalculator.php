<?php

namespace Gt\Measures\Domain;

use DateTimeZone;
use DateTimeInterface;

interface IDayCalculator
{
    public function getTimestampShift() : int;
    public function getTimeZone() : DateTimeZone;

    public function getDayKey(int $timestamp): string;
    public function getWeekKey(int $timestamp): string;
    public function getMonthKey(int $timestamp): string;

    public function getShiftedDate(int $timestamp) : DateTimeInterface;
}