<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;
use \ArrayIterator;

class Day07SolutionTest extends SolutionTestCase
{
    const INPUT = <<<INPUT
pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)
INPUT;

    public function test_part1()
    {
        $this->mockReader
            ->shouldReceive('readAll')
            ->once()
            ->andReturn(new ArrayIterator(explode("\n", self::INPUT)));

        $this->assertEquals('tknk', $this->solution->part1());
    }

    public function test_part2()
    {
        $this->mockReader
            ->shouldReceive('readAll')
            ->once()
            ->andReturn(new ArrayIterator(explode("\n", self::INPUT)));

        $this->assertEquals('60', $this->solution->part2());
    }
}
