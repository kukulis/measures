<?php

namespace Draft;

use Gt\Measures\Domain\ComputedMeasure;
use Gt\Measures\Domain\Loader;
use Gt\Measures\Domain\Measure;
use Gt\Measures\Util\Grouper;
use PHPUnit\Framework\TestCase;

class TestGroup extends TestCase
{
    public function testParseAndGroup () {
        $file = __DIR__.'/../../data/data.csv';

        $loader = new Loader();

        $measures = $loader->loadMeasures($file);

        // TODO shift by the start of 08:00:00
        $groupedByDay = Grouper::group($measures, fn(Measure $measure)=> $measure->getDayStart());


        $computedMeasures = [];
        foreach ($groupedByDay as $day => $group ) {
            $computedMeasures[] = (new ComputedMeasure())->computeFromMeasures($group);
        }

        $this->assertGreaterThan(0, $computedMeasures);
    }

}