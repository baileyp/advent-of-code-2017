<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day08SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('1', $this->solution->part1());
    }

    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('10', $this->solution->part2());
    }
}
