<?php

namespace App\Test\Solution\Day20;

use App\Solution\Day20\Vector;
use PHPUnit\Framework\TestCase;

class VectorTest extends TestCase
{
    public function testBasics()
    {
        $vector = new Vector(4, -3, 12);

        $this->assertEquals(4, $vector->x());
        $this->assertEquals(-3, $vector->y());
        $this->assertEquals(12, $vector->z());
        
        $this->assertEquals("4,-3,12", (string) $vector);
    }

    public function test_sum()
    {
        $one = new Vector(4, -3, 12);
        $two = new Vector(5, 10, -20);

        $expected = new Vector(4 + 5, -3 + 10, 12 + -20);

        $this->assertEquals($expected, $one->sum($two));
        $this->assertEquals($expected, $two->sum($one));

        $this->assertNotSame($one, $one->sum(new Vector(0, 0, 0)));
    }

    public function test_distance()
    {
        $vector = new Vector(4, -3, 12);

        $this->assertEquals(19, $vector->distance());
        $this->assertEquals(0, $vector->distance($vector));

        $from = new Vector(-5, 1, 8);
        $expected = sqrt(81 + 16 + 16);
        $this->assertEquals($expected, $vector->distance($from));
    }
}
