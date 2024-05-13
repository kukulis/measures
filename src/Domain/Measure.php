<?php

namespace Gt\Measures\Domain;

use Gt\Measures\Util\Bounder;

class Measure
{
    const DAY_LENGTH = 24* 60*60;
    const WEEK_LENGTH = 7*24*60*60;

    private int $timestamp;
    private string $metric;
    private float $value;

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): Measure
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getMetric(): string
    {
        return $this->metric;
    }

    public function setMetric(string $metric): Measure
    {
        $this->metric = $metric;
        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): Measure
    {
        $this->value = $value;
        return $this;
    }

    public function fromArray($data) : self{
        $this->timestamp = intval($data[0]);
        $this->metric = $data[1];
        $this->value = $data[2];

        return $this;
    }

    // month start much more complex
    public function getDayStart() : float {
        // TODO shift by hour 08:00:00 and cover with test
        return Bounder::step($this->timestamp, self::DAY_LENGTH );
    }

    public function bigger(Measure $measure) : self {
        if ( $measure->getValue() > $this->value) {
            return $measure;
        }
        return $this;
    }
}