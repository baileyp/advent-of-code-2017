<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day23SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
set b 67
set c b
jnz a 2
jnz 1 5
mul b 100
sub b -100000
set c b
sub c -17000
set f 1
set d 2
set e 2
set g d
mul g e
sub g b
jnz g 2
set f 0
sub e -1
set g e
sub g b
jnz g -8
sub d -1
set g d
sub g b
jnz g -13
jnz f 2
sub h -1
set g b
sub g c
jnz g 2
jnz 1 3
sub b -17
jnz 1 -23
INPUT;


    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('4225', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('905', $this->solution->part2());
    }
}