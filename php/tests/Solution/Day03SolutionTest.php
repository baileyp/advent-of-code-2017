<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day03SolutionTest extends SolutionTestCase
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
            ['1', '0'],
            ['12', '3'],
            ['23', '2'],
            ['1024', '31'],
        ];
    }

    /**
     * @dataProvider dp_part2
     */
    public function test_part2(string $input, string $result): void
    {
        $this->expectReadLine($input);
        $this->assertEquals($result, $this->solution->part2());
    }

    public function dp_part2(): array
    {
        return [
            ['6', '10'],
            ['12', '23'],
            ['60', '122'],
            ['122', '133'],
            ['147', '304'],
        ];
    }

    /**
     * @expectedException \LogicException
     */
    public function test_part2LowValueThrowsLogicException()
    {
        $this->mockReader
            ->shouldReceive('readLine')
            ->once()
            ->andReturn('3');

        $this->solution->part2();
    }
}
