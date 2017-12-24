<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day22SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
..#
#..
...
INPUT;

    /**
     * @dataProvider dp_part1
     */
    public function test_part1(int $bursts, string $infections)
    {
        $this->expectReadAll();
        $this->assertEquals($infections, $this->solution->part1($bursts));
    }

    public function dp_part1(): array
    {
        return [
            [70, '41'],
            [10000, '5587'],
        ];
    }

    /**
     * @dataProvider dp_part2
     */
    public function test_part2(int $bursts, string $infections)
    {
        $this->expectReadAll();
        $this->assertEquals($infections, $this->solution->part2($bursts));
    }

    public function dp_part2(): array
    {
        return [
            [100, '26'],
//            [10000, '5587'],
        ];
    }
}