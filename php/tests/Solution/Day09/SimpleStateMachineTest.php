<?php

namespace App\Test\Day09;

use App\Solution\Day09\SimpleStateMachine;
use PHPUnit\Framework\TestCase;
use \Throwable;
use \LogicException;
use \OutOfBoundsException;

class SimpleStateMachineTest extends TestCase
{
    /**
     * @dataProvider dp_run
     */
    public function test_run(string $input, string $result)
    {
        $state = ['counter' => 0];
        $operations = [
            '^' => function(SimpleStateMachine $state) {
                $state['counter'] = $state['counter'] + 1;
            },
            '!' => function(SimpleStateMachine $state, &$loop) {
                $loop++;
            }
        ];
        $default = function(SimpleStateMachine $state) {
            $state['counter'] = 0;
        };

        $machine = new SimpleStateMachine($state, $operations, $default);

        $machine->run($input);

        $this->assertEquals($result, $machine['counter']);
    }

    public function dp_run()
    {
        return [
            ['^', 1],
            ['^^^', 3],
            ['^!^^', 2],
            ['^^^^a^', 1],
            ['^^^^!a^', 5],
        ];
    }

    public function testArrayAccess()
    {
        $machine = new SimpleStateMachine(['allowed' => 42, 'state' => 'foobar'], [], function(){});

        // offsetExists()
        $this->assertTrue(isset($machine['allowed']));
        $this->assertTrue(isset($machine['state']));
        $this->assertFalse(isset($machine['foobar']));

        // offsetGet()
        $this->assertEquals(42, $machine['allowed']);
        $this->assertEquals('foobar', $machine['state']);
        try {
            $machine['foobar'];
        }
        catch (Throwable $e) {
            $this->assertInstanceOf(OutOfBoundsException::class, $e);
        }

        // offsetSet()
        $this->assertEquals(0, $machine['allowed'] = 0);
        $this->assertEquals(0, $machine['allowed']);
        try {
            $machine['foobar'] = 'baz';
        }
        catch (Throwable $e) {
            $this->assertInstanceOf(OutOfBoundsException::class, $e);
        }

        // offsetUnset()
        try {
            unset($machine['allowed']);
        }
        catch (Throwable $e) {
            $this->assertInstanceOf(LogicException::class, $e);
        }
    }
}
