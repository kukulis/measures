<?php

namespace Tests\Unit;

use DateTimeZone;
use Gt\Measures\Domain\DirectDayCalculator;
use Gt\Measures\Domain\SmartDayCalculator;
use PHPUnit\Framework\TestCase;

/**
 * Was not sure at the beginning if the smart day calculator works correctly.
 * So this test proves that it works correctly, except this test did not find the test data set,
 * with which  SmartDayCalculator is wrong.
 *
 * Better way would be to prove correctness mathematically.
 */
class CompareDayCalculatorTest extends TestCase
{
    /**
     * @dataProvider provideTimestamps
     */
    public function testDay(int $timestampShift, DateTimeZone $timezone, $timestamp, $expectedDay)
    {
        $calculator = new DirectDayCalculator($timezone, $timestampShift);
        $day = $calculator->getDayKey($timestamp);
        $this->assertEquals($expectedDay, $day);

        $calculatorSmart = new SmartDayCalculator($timezone, $timestampShift);

        $daySmart = $calculatorSmart->getDayKey($timestamp);
        $this->assertEquals($expectedDay, $daySmart);
    }

    public static function provideTimestamps(): array
    {
        return [
            'test1' => [
                'timestampShift' => 8 * 60 * 60,
                'timezone' => new DateTimeZone('UTC'),
                'timestamp' => 1715817600, // 2024-05-16 00:00:00+00
                '2024-05-15',
            ],
            'test 2' => [
                'timestampShift' => 8 * 60 * 60,
                'timezone' =>  new DateTimeZone('UTC'),
                'timestamp' => 1715817600 + 6*60*60,
                '2024-05-15',
            ],
            'test 3' => [
                'timestampShift' => 8 * 60 * 60,
                'timezone' =>  new DateTimeZone('+3'),
                'timestamp' => 1715817600 + 6*60*60,
                '2024-05-16',
            ],
            'test USA' => [
                'timestampShift' => 8 * 60 * 60,
                'timezone' =>  new DateTimeZone('-6'),
                'timestamp' => 1715817600 + 14*60*60,
                '2024-05-16',
            ],
        ];
    }

}