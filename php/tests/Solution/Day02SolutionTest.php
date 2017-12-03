<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day02SolutionTest extends SolutionTestCase
{
    public function test_part1()
    {
        $input = ["5\t1\t9\t5", "7\t5\t3", "2\t4\t6\t8"];

        $this->mockReader
            ->shouldReceive('readLine')
            ->andReturn($input[0], $input[1], $input[2], null);

        $this->assertEquals('18', $this->solution->part1());
    }

    public function test_part2()
    {
        $input = ["5\t9\t2\t8", "9\t4\t7\t3", "3\t8\t6\t5"];

        $this->mockReader
            ->shouldReceive('readLine')
            ->andReturn($input[0], $input[1], $input[2], null);

        $this->assertEquals('9', $this->solution->part2());
    }
}
