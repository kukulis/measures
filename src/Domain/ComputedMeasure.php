<?php

namespace Gt\Measures\Domain;

use DateTimeInterface;

class ComputedMeasure
{
    private DateTimeInterface $date;
    private float $sum;
    private float $peakValue;
    private int $peakTimestamp;

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): ComputedMeasure
    {
        $this->date = $date;
        return $this;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum): ComputedMeasure
    {
        $this->sum = $sum;
        return $this;
    }

    public function getPeakValue(): float
    {
        return $this->peakValue;
    }

    public function setPeakValue(float $peakValue): ComputedMeasure
    {
        $this->peakValue = $peakValue;
        return $this;
    }

    public function getPeakTimestamp(): int
    {
        return $this->peakTimestamp;
    }

    public function setPeakTimestamp(int $peakTimestamp): ComputedMeasure
    {
        $this->peakTimestamp = $peakTimestamp;
        return $this;
    }

    /**
     * @param Measure[] $measures
     */
    public function computeFromMeasures(array $measures): self
    {
        $peakMeasure = (new Measure())->setValue(0);
        $sum = 0;
        foreach ($measures as $measure) {
            $peakMeasure = $peakMeasure->bigger($measure);
            $sum += $measure->getValue();
        }

        $this->sum = $sum;
        $this->peakValue = $peakMeasure->getValue();
        $this->peakTimestamp = $peakMeasure->getTimestamp();

        return $this;
    }
}