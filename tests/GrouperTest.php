<?php

namespace Tests;

use Gt\Measures\Domain\Measure;
use Gt\Measures\Util\Bounder;
use Gt\Measures\Util\Grouper;
use PHPUnit\Framework\TestCase;

class GrouperTest extends TestCase
{
    /**
     * @dataProvider provideMeasures
     */
    public function testGrouper(array $data, int $step,  array $expectedGroupedData) {
        $groupedData = Grouper::group($data, fn(Measure $measure) => Bounder::step($measure->getTimestamp(), $step));

        $this->assertEquals($expectedGroupedData, $groupedData);
    }

    public static function provideMeasures() : array {
        return [
            'test 1' => [
                'data' => [
                    (new Measure())->setTimestamp(100)->setMetric('A')->setValue(3),
                    (new Measure())->setTimestamp(150)->setMetric('A')->setValue(4),
                    (new Measure())->setTimestamp(200)->setMetric('A')->setValue(5),
                    (new Measure())->setTimestamp(250)->setMetric('A')->setValue(6),
                    (new Measure())->setTimestamp(300)->setMetric('A')->setValue(7),
                    (new Measure())->setTimestamp(350)->setMetric('A')->setValue(8),
                    (new Measure())->setTimestamp(400)->setMetric('A')->setValue(9),
                ],
                'step' => 200,
                'expectedGroupedData' => [
                    0 => [
                        (new Measure())->setTimestamp(100)->setMetric('A')->setValue(3),
                        (new Measure())->setTimestamp(150)->setMetric('A')->setValue(4),
                    ],
                    200 => [
                        (new Measure())->setTimestamp(200)->setMetric('A')->setValue(5),
                        (new Measure())->setTimestamp(250)->setMetric('A')->setValue(6),
                        (new Measure())->setTimestamp(300)->setMetric('A')->setValue(7),
                        (new Measure())->setTimestamp(350)->setMetric('A')->setValue(8),
                    ],
                    400 => [
                        (new Measure())->setTimestamp(400)->setMetric('A')->setValue(9),
                    ]
                ]
            ]
        ];
    }

}