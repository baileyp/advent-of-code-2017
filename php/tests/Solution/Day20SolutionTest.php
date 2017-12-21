<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day20SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
p=< 3,0,0>, v=< 2,0,0>, a=<-1,0,0>
p=< 4,0,0>, v=< 0,0,0>, a=<-2,0,0>
INPUT;


    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('0', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $input = <<<INPUT
p=<-6,0,0>, v=< 3,0,0>, a=< 0,0,0>
p=<-4,0,0>, v=< 2,0,0>, a=< 0,0,0>
p=<-2,0,0>, v=< 1,0,0>, a=< 0,0,0>
p=< 3,0,0>, v=<-1,0,0>, a=< 0,0,0>
INPUT;

        $this->expectReadAll($input);
        $this->assertEquals('1', $this->solution->part2());
    }
}