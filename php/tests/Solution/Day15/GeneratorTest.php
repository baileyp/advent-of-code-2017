<?php

namespace App\Test\Solution\Day15;

use App\Solution\Day15\Generator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    public function test_nextValue()
    {
        $generator = new Generator(Generator::DIVISOR + 1, 2);

        $this->assertEquals(2, $generator->nextValue());
        $this->assertEquals(4, $generator->nextValue());
        $this->assertEquals(8, $generator->nextValue());
        $this->assertEquals(16, $generator->nextValue());
    }
}
