<?php

namespace Gt\Measures\Domain;

class Loader
{
    /**
     * @return Measure[]
     */
    public function loadMeasures( string $csvFile) : array {
        $f = fopen($csvFile, 'r');
        $measures = [];
        while ( $row = fgetcsv($f, null, ';') ) {
            $measures [] = (new Measure())->fromArray($row);
        }

        return $measures;
    }
}