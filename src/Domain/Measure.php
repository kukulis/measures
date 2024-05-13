<?php

namespace Gt\Measures\Domain;

use Spatie\DataTransferObject\DataTransferObject;

class Measure
{
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
}