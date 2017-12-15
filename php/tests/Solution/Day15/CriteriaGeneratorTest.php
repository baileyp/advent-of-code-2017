<?php

namespace App\Test\Solution\Day15;

use App\Solution\Day15\CriteriaGenerator;
use PHPUnit\Framework\TestCase;

class CriteriaGeneratorTest extends TestCase
{
    public function test_nextValue()
    {
        $generator = new CriteriaGenerator(3, 3);

        $powersOfThree = array_map(function(int $pow) {
            return 3 ** $pow;
        }, range(2, 7));

        $generator->setCriteria(function (int $value) use (&$powersOfThree) {
            $this->assertEquals(array_shift($powersOfThree), $value);
            return ((string) $value){0} === '2';
        });

        $this->assertEquals(27, $generator->nextValue());
        $this->assertEquals(243, $generator->nextValue());
        $this->assertEquals(2187, $generator->nextValue());
    }
}
