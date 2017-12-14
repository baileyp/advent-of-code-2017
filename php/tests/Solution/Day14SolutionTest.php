<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day14SolutionTest extends SolutionTestCase
{
    const INPUT = 'flqrgnkx';

    public function test_part1()
    {
        $this->expectReadLine();
        $this->assertEquals('8108', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadLine();
        $this->assertEquals('1242', $this->solution->part2());
    }
}