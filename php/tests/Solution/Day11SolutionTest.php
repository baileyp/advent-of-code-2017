<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day11SolutionTest extends SolutionTestCase
{
    const INPUT = '';

    /**
     * @dataProvider dp_part1
     */
    public function test_part1(string $input, string $result)
    {
        $this->expectReadLine($input);
        $this->assertEquals($result, $this->solution->part1());
    }

    public function dp_part1(): array
    {
        return [
            ['ne,ne,ne', '3'],
            ['ne,ne,sw,sw', '0'],
            ['ne,ne,s,s', '2'],
            ['se,sw,se,sw,sw', '3'],
        ];
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
            ['ne,ne,ne', '3'],
            ['ne,ne,sw,sw', '2'],
            ['ne,ne,s,s,s,n', '3'],
        ];
    }
}