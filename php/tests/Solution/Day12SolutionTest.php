<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day12SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('6', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('2', $this->solution->part2());
    }
}