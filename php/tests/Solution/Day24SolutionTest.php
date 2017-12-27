<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day24SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
0/2
2/2
2/3
3/4
3/5
0/1
10/1
9/10
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('31', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('19', $this->solution->part2());
    }
}
