<?php

namespace Tests\Unit;

use Gt\Measures\Domain\Measure;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    /**
     * @dataProvider provideMeasureData
     */
    public function testConvert(array $data, Measure $expectedMeasure) {
        $measure = (new Measure())->fromArray($data);

        $this->assertEquals($measure, $expectedMeasure);
    }

    public static function provideMeasureData() : array {
        return [
            'simple' => [
                'data' => [
                    '1306890000', '000000250612-DI1', '545.00'
                ],
                'expectedMeasure' => (new Measure())
                    ->setTimestamp(1306890000)
                    ->setMetric('000000250612-DI1')
                    ->setValue(545.00)
            ]
        ];
    }
}