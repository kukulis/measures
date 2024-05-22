<?php

namespace Gt\Measures\Domain;

use DateTimeZone;
use Gt\Measures\Util\Grouper;

class MeasuresController
{
    /**
     * @return ComputedMeasure[]
     */
    public function prepareDailyMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift): array
    {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare(
            $file,
            fn(Measure $measure) => $dayCalculator->getDayKey($measure->getTimestamp()),
            $dayCalculator
        );
    }

    /**
     * @return ComputedMeasure[]
     */
    public function prepareWeeklyMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift): array
    {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare(
            $file,
            fn(Measure $measure) => $dayCalculator->getWeekKey($measure->getTimestamp()),
            $dayCalculator
        );
    }

    /**
     * @return ComputedMeasure[]
     */
    public function prepareMonthlyMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift): array
    {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare(
            $file,
            fn(Measure $measure) => $dayCalculator->getMonthKey($measure->getTimestamp()),
            $dayCalculator
        );
    }

    public function prepareQuarterMeasures(string $file, DateTimeZone $dateTimeZone, int $timeShift): array
    {
        $dayCalculator = new SmartDayCalculator($dateTimeZone, $timeShift);
        return $this->innerPrepare(
            $file,
            fn(Measure $measure) => $dayCalculator->getQuarterKey($measure->getTimestamp()),
            $dayCalculator
        );
    }

    /**
     * @return ComputedMeasure[]
     */
    public function innerPrepare(string $file, callable $keyGetter, IDayCalculator $dayCalculator): array
    {
        $loader = new Loader();
        $measures = $loader->loadMeasures($file);

        /** @var Measure[][] $groups */
        $groups = Grouper::group($measures, $keyGetter);

        return array_map(fn($group) => (new ComputedMeasure())->computeFromMeasures($group, $dayCalculator),
            $groups);
    }
}