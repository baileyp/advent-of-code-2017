<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day19SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
     |          
     |  +--+    
     A  |  C    
 F---|----E|--+ 
     |  |  |  D 
     +B-+  +--+ 
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('ABCDEF', $this->solution->part1());
    }
    
    public function test_part2()
    {
        $this->expectReadAll();
        $this->assertEquals('38', $this->solution->part2());
    }
}