<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day17SolutionTest extends SolutionTestCase
{
    const INPUT = '3';

    public function test_part1()
    {
        $this->expectReadLine();
        $this->assertEquals('638', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadLine();
        $this->assertEquals('1222153', $this->solution->part2());
    }
}