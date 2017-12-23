<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day21SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
../.# => ##./#../...
.#./..#/### => #..#/..../..../#..#
INPUT;

    public function test_part1()
    {
        $this->expectReadAll();
        $this->assertEquals('12', $this->solution->part1(2));
    }
}