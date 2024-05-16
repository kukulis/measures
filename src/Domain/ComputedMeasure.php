<?php

namespace Gt\Measures\Domain;

use Carbon\Carbon;
use DateTimeInterface;

class ComputedMeasure
{
    private DateTimeInterface $date;
    private float $sum;
    private float $peakValue;

    private Carbon $peakDate;



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

    public function getPeakDate() : Carbon {
        return $this->peakDate;
    }


    /**
     * @param Measure[] $measures
     */
    public function computeFromMeasures(array $measures, IDayCalculator $calculator): self
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

        $this->peakDate = Carbon::createFromTimestamp($peakMeasure->getTimestamp(), $calculator->getTimeZone());

        $timestamp = 0;
        if ( count($measures) > 0 ) {
            $measure = reset($measures);
            $timestamp = $measure->getTimestamp();
        }

        $this->date = $calculator->getShiftedDate($timestamp);

        return $this;
    }
}