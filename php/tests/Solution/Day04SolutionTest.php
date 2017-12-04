<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day04SolutionTest extends SolutionTestCase
{
    public function test_part1()
    {
        $line1 = "aa bb cc dd ee";
        $line2 = "aa bb cc dd aa";
        $line3 = "aa bb cc dd aaa";

        $this->mockReader
            ->shouldReceive('readLine')
            ->andReturn($line1, $line2, $line3, null);

        $this->assertEquals('2', $this->solution->part1());
    }

    public function test_part2()
    {
        $line1 = "abcde fghij";
        $line2 = "abcde xyz ecdab";
        $line3 = "a ab abc abd abf abj";
        $line4 = "iiii oiii ooii oooi oooo";
        $line5 = "oiii ioii iioi iiio";

        $this->mockReader
            ->shouldReceive('readLine')
            ->andReturn($line1, $line2, $line3, $line4, $line5, null);

        $this->assertEquals('3', $this->solution->part2());
    }
}