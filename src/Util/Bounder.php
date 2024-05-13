<?php

namespace Gt\Measures\Util;

class Bounder
{
    public static function step( int $data, int $step ) : int {
        return floor($data / $step) * $step;
    }
}