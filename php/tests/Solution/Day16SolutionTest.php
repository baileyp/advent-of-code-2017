<?php

namespace App\Test\Solution;

use App\Solution\Day16Solution;
use App\Test\SolutionTestCase;

class Day16SolutionTest extends SolutionTestCase
{
    const INPUT = 's1,x3/4,pe/b';

    public function test_part1()
    {
        $this->solution = new class($this->mockReader) extends Day16Solution
        {
            const HIGH_PROGRAM = 'e';
        };
        $this->expectReadLine();
        $this->assertEquals('baedc', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->solution = new class($this->mockReader) extends Day16Solution
        {
            const HIGH_PROGRAM = 'e';
        };
        $this->expectReadLine();
        $this->assertEquals('abcde', $this->solution->part2());
    }
}