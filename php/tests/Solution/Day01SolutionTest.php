<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day01SolutionTest extends SolutionTestCase
{
    /**
     * @dataProvider dp_part1
     */
    public function test_part1(string $input, string $result): void
    {
        $this->expectReadLine($input);
        $this->assertEquals($result, $this->solution->part1());
    }

    public function dp_part1(): array
    {
        return [
            ['1122', '3'],
            ['1111', '4'],
            ['1234', '0'],
            ['91212129', '9'],
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
            ['1212', '6'],
            ['1221', '0'],
            ['123425', '4'],
            ['123123', '12'],
            ['12131415', '4'],
        ];
    }
}
