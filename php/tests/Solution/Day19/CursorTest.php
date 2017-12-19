<?php

namespace App\Test\Solution\Day19;

use App\Solution\Day19\Cursor;
use PHPUnit\Framework\TestCase;

class CursorTest extends TestCase
{
    /**
     * @dataProvider dpAll
     */
    public function testAll(string $direction, int $expectedRow, int $expectedCol)
    {
        $cursor = new Cursor(0, 0);

        $moved = $cursor->move($direction);

        $this->assertNotSame($cursor, $moved);

        $this->assertEquals(0, $cursor->row());
        $this->assertEquals(0, $cursor->col());

        $this->assertEquals($expectedRow, $moved->row());
        $this->assertEquals($expectedCol, $moved->col());
    }

    public function dpAll(): array
    {
        return [
            ['N', -1, 0],
            ['S', 1, 0],
            ['E', 0, 1],
            ['W', 0, -1],
        ];
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function test_move_unrecognizedDirectionThrowsUnexpectedValueException()
    {
        (new Cursor(0, 0))->move('U');
    }
}
