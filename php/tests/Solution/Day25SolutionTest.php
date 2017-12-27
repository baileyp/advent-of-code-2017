<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day25SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
Begin in state A.
Perform a diagnostic checksum after 6 steps.

In state A:
  If the current value is 0:
    - Write the value 1.
    - Move one slot to the right.
    - Continue with state B.
  If the current value is 1:
    - Write the value 0.
    - Move one slot to the left.
    - Continue with state B.

In state B:
  If the current value is 0:
    - Write the value 1.
    - Move one slot to the left.
    - Continue with state A.
  If the current value is 1:
    - Write the value 1.
    - Move one slot to the right.
    - Continue with state A.
INPUT;


    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('3', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->assertEquals("Clink the link!", $this->solution->part2());
    }
}