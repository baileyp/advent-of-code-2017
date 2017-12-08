<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day06SolutionTest extends SolutionTestCase
{
    const INPUT = "0\t2\t7\t0";

    public function test_part1()
    {
        $this->expectReadLine();
        $this->assertEquals('5', $this->solution->part1());
    }

    public function test_part2()
    {
        $this->expectReadLine();
        $this->assertEquals('4', $this->solution->part2());
    }
}
