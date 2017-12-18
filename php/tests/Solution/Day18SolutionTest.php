<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day18SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
set a 1
add a 2
mul a a
mod a 5
snd a
set a 0
rcv a
jgz a -1
set a 1
jgz a -2
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('4', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $input = <<<INPUT
snd 1
snd 2
snd p
rcv a
rcv b
rcv c
rcv d
INPUT;

        $this->expectReadAll($input);
        $this->assertEquals('3', $this->solution->part2());
    }
}