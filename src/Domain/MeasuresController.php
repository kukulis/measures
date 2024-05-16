<?php

namespace Gt\Measures\Domain;

use Gt\Measures\Util\Grouper;
use DateTimeZone;

class MeasuresController
{
    /**
     * @return ComputedMeasure[]
     */
    public function prepareDailyMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift) : array {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare( $file, fn(Measure $measure)=>$dayCalculator->getDayKey($measure->getTimestamp()), $dayCalculator);
    }

    /**
     * @return ComputedMeasure[]
     */
    public function prepareWeeklyMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift) : array {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare( $file, fn(Measure $measure)=>$dayCalculator->getWeekKey($measure->getTimestamp()), $dayCalculator);
    }

    /**
     * @return ComputedMeasure[]
     */
    public function prepareMonthlyMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift) : array {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare( $file, fn(Measure $measure)=>$dayCalculator->getMonthKey($measure->getTimestamp()), $dayCalculator);
    }

    /**
     * @return ComputedMeasure[]
     */
    public function innerPrepare( string $file, callable $keyGetter, IDayCalculator $dayCalculator ) : array {
        $loader = new Loader();

        $measures = $loader->loadMeasures($file);
        $groupedByDay = Grouper::group($measures, $keyGetter);

        $computedMeasures = [];
        foreach ($groupedByDay as $key => $group) {
            $computedMeasure = (new ComputedMeasure())->computeFromMeasures($group);

            $computedMeasure->setDate( $dayCalculator->getShiftedDate($group[0]) );

            $computedMeasures[$key] = $computedMeasure;
        }

        return $computedMeasures;
    }
}