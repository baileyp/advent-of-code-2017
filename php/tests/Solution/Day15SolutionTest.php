<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;
use App\Solution\Day15Solution;

class Day15SolutionTest extends SolutionTestCase
{
    const INPUT = '';

    public function test_part1()
    {
        $this->solution = new class($this->mockReader) extends Day15Solution
        {
            const ITERATIONS_1 = 5;
        };
        $this->expectReadLine('Generator A starts with 65');
        $this->expectReadLine('Generator B starts with 8921');
        $this->assertEquals('1', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->solution = new class($this->mockReader) extends Day15Solution
        {
            const ITERATIONS_2 = 1056;
        };
        $this->expectReadLine('Generator A starts with 65');
        $this->expectReadLine('Generator B starts with 8921');
        $this->assertEquals('1', $this->solution->part2());
    }
}