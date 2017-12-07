<?php

namespace App\Test\Solution\Day07;

use App\Solution\Day07\Program;
use App\Solution\Day07\Tower;
use PHPUnit\Framework\TestCase;

use \Mockery as m;

class TowerTest extends TestCase
{
    /**
     * @var Tower
     */
    private $tower;

    public function setUp()
    {
        $this->tower = new Tower();
    }

    public function tearDown()
    {
        unset($this->tower);
        m::close();
    }

    public function testBasics()
    {
        $name = 'program 42';
        $mockProgram = m::mock(Program::class, [
            'name' => $name
        ]);

        $this->assertNull($this->tower->addProgram($mockProgram));
        $this->assertSame($mockProgram, $this->tower->findProgram($name));
    }

    public function testAssociations()
    {
        $name = 'program 42';
        $childNames = ['child 1', 'child 2', 'child 3'];
        $mockProgram = m::mock(Program::class, [
            'name' => $name
        ]);

        $children = array_map(function($child) use ($mockProgram) {
            $mockChild = m::mock(Program::class, [
                'name' => $child,
                'supportedBy' => $mockProgram
            ]);

            $mockProgram
                ->shouldReceive('addToDisc')
                ->once()
                ->with($mockChild);

            return $mockChild;
        }, $childNames);

        $mockProgram
            ->shouldReceive('supportedBy')
            ->once()
            ->andReturnNull();

        $this->tower->addProgram($mockProgram);
        foreach ($children as $child) {
            $this->tower->addProgram($child);
        }

        $this->tower->writeProgramsToDisc($name, ...$childNames);

        $this->assertSame($mockProgram, $this->tower->base());
    }
}
