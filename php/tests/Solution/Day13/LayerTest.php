<?php

namespace App\Test\Day13;

use App\Solution\Day13\Layer;
use PHPUnit\Framework\TestCase;

class LayerTest extends TestCase
{
    /**
     * @dataProvider dpAll
     */
    public function testAll(int $range, int $picoSeconds, int $position)
    {
        $layer = new Layer($range);

        $this->assertEquals($range, $layer->range());
        $this->assertEquals($position, $layer->scannerPositionAfterTime($picoSeconds));
    }

    public function dpAll(): array
    {
        return [
            [1, rand(0, 100), 0],
            [3, 4, 0],
            [3, 1, 1],
            [3, 5, 1],

            // Full cycle
            [5, 64, 0],
            [5, 65, 1],
            [5, 66, 2],
            [5, 67, 3],
            [5, 68, 4],
            [5, 69, 3],
            [5, 70, 2],
            [5, 71, 1],
            [5, 72, 0],
        ];
    }
}
