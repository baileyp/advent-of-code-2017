<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;
use \ArrayIterator;

class Day05SolutionTest extends SolutionTestCase
{
    public function test_part1()
    {
        $input = ['0', '3', '0', '1', '-3'];

        $this->mockReader
            ->shouldReceive('readAll')
            ->once()
            ->andReturn(new ArrayIterator($input));

        $this->assertEquals('5', $this->solution->part1());
    }

    public function test_part2()
    {
        $input = ['0', '3', '0', '1', '-3'];

        $this->mockReader
            ->shouldReceive('readAll')
            ->once()
            ->andReturn(new ArrayIterator($input));

        $this->assertEquals('10', $this->solution->part2());
    }
}
