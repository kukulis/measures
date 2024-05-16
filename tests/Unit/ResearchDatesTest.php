<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ResearchDatesTest extends TestCase
{
    public function testTimestamp() {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2024-05-16 00:00:00', new \DateTimeZone('UTC'));
        $timestamp = $date->getTimestamp();

        $this->assertGreaterThan(0, $timestamp);

        $date2 = \DateTime::createFromFormat(\DateTime::ATOM, '2024-05-16T00:00:00P', new \DateTimeZone('UTC') );

        $timestamp2 = $date2->getTimestamp();

        $hoursDiff2 = ( $timestamp2 - $timestamp ) / (60* 60);
        echo "hoursDiff2=$hoursDiff2\n";



        // it seems the ATOM format ignores time zone
        $this->assertEquals($timestamp, $timestamp2-3*60*60);

        $date3 = new \DateTime('2024-05-16 00:00:00', new \DateTimeZone('UTC'));
        $timestamp3 = $date3->getTimestamp();

        $this->assertEquals($timestamp, $timestamp3);

        $date4 = new \DateTime('2024-05-16 00:00:00', new \DateTimeZone('+3'));
        $timestamp4 = $date4->getTimestamp();

        echo "$timestamp
        $timestamp2
        $timestamp3
        $timestamp4\n";


//        $this->assertEquals($timestamp2, $timestamp4);

        $hoursDiff4 = ( $timestamp4 - $timestamp ) / (60* 60);

        echo "hoursDiff4=$hoursDiff4\n";

        // -3 because,
        // when time zone is +3, then its representation comparing to the global time is +3
        // meaning that timestampX -> representation UTC
        // and timestampX -> representation +3
        // the (representation +3) is 3 hours greater than (representation UTC)
        // but here
        // we test same representation:
        // representationY = '2024-05-16 00:00:00'
        // to get the same representation with zone +3 we need -3 hours lesser timestamp.
        $this->assertEquals(-3, $hoursDiff4);
    }

}