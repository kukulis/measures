<?php

namespace Gt\Measures\Domain;

class ComputedMeasure
{
    private string $date;
    private float $sum;
    private float $peakValue;
    private int $peakTimestamp;

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): ComputedMeasure
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
    public function computeFromMeasures(array $measures) : self {
        $peakMeasure = (new Measure())->setValue(0);
        $sum = 0;
        foreach ($measures as $measure) {
             $peakMeasure = $peakMeasure->bigger($measure);
             $sum += $measure->getValue();
        }

        $this->sum = $sum;
        $this->peakValue = $peakMeasure->getValue();
        $this->peakTimestamp = $peakMeasure->getTimestamp();

        // TODO calculate date
        $this->date = 'TODO';

        return $this;
    }
}