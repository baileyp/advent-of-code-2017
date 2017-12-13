<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day13SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
0: 3
1: 2
4: 4
6: 4
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('24', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('10', $this->solution->part2());
    }
}