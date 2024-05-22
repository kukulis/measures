<?php

namespace Gt\Measures\Domain;

class Measure
{
//    const DAY_LENGTH = 24* 60*60;
//    const WEEK_LENGTH = 7*24*60*60;

// we begining of the week in some date 2000 or 1970 we have timestamp of this date - startTimestamp
// floor( (currentTimestamp - startTimestamp)  / WEEK_LENGTH )

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
    public function bigger(Measure $measure) : self {
        if ( $measure->getValue() > $this->value) {
            return $measure;
        }
        return $this;
    }
}