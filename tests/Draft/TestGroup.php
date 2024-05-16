<?php

namespace Draft;

use DateTimeZone;
use Gt\Measures\Domain\ComputedMeasure;
use Gt\Measures\Domain\Loader;
use Gt\Measures\Domain\Measure;
use Gt\Measures\Domain\SmartDayCalculator;
use Gt\Measures\Util\Grouper;
use PHPUnit\Framework\TestCase;

class TestGroup extends TestCase
{
    public function testParseAndGroup()
    {
        $file = __DIR__ . '/../../data/data.csv';

        $loader = new Loader();

        $measures = $loader->loadMeasures($file);

        $dayCalculator = new SmartDayCalculator(new DateTimeZone('Europe/Vilnius'), 8 * 60 * 60);

        $groupedByDay = Grouper::group($measures, fn(Measure $measure) => $dayCalculator->getDayKey( $measure->getTimestamp()));


        $computedMeasures = [];
        foreach ($groupedByDay as $day => $group) {
            $computedMeasures[] = (new ComputedMeasure())->computeFromMeasures($group);
        }

        $this->assertGreaterThan(0, $computedMeasures);
    }

}