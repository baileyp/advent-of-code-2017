<?php

namespace App\Test\Solution;

use App\Solution\Day10Solution;
use App\Test\SolutionTestCase;

class Day10SolutionTest extends SolutionTestCase
{
    const INPUT = '';

    public function test_part1()
    {
        $this->solution = new class($this->mockReader) extends Day10Solution
        {
            const LIST_SIZE = 5;
        };

        $this->expectReadLine('3,4,1,5');
        $this->assertEquals('12', $this->solution->part1());
    }

    /**
     * @dataProvider dp_part2
     */
    public function test_part2(string $input, string $result)
    {
        $this->expectReadLine($input);
        $this->assertEquals($result, $this->solution->part2());
    }

    public function dp_part2(): array
    {
        return [
            ['', 'a2582a3a0e66e6e86e3812dcb672a272'],
            ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'],
            ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'],
            ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'],
        ];
    }
}