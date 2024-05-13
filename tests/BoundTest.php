<?php

namespace Test;

use Gt\Measures\Util\Bounder;
use PHPUnit\Framework\TestCase;

class BoundTest extends TestCase
{
    /**
     * @dataProvider provideBounds
     */
    public function testStep(int $data, int $step, int $expectedValue)
    {
        $value = Bounder::step($data, $step);

        $this->assertEquals($expectedValue, $value);
    }

    public static function provideBounds(): array
    {
        return [
            'test 1' => [
                'data' => 10,
                'step' => 3,
                'expectedValue' => 9
            ],
            'test 2' => [
                'data' => 21,
                'step' => 4,
                'expectedValue' => 20
            ]
        ];
    }

}