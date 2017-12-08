<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;
use \ArrayIterator;

class Day05SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
0
3
0
1
-3
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('5', $this->solution->part1());
    }

    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('10', $this->solution->part2());
    }
}
