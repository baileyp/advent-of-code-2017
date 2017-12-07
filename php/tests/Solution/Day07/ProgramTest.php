<?php
/**
 * Created by PhpStorm.
 * User: pbailey
 * Date: 12/7/17
 * Time: 5:12 PM
 */

namespace App\Test\Solution\Day07;

use App\Solution\Day07\Program;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class ProgramTest extends TestCase
{
    const NAME = 'Program 42';
    const WEIGHT = 42;

    /**
     * @var Program
     */
    private $program;

    public function setUp()
    {
        $this->program = new Program(self::NAME, self::WEIGHT);
    }

    public function tearDown()
    {
        unset($this->program);
        m::close();
    }

    public function testBasics()
    {
        $this->assertEquals(self::NAME, $this->program->name());
        $this->assertEquals(self::WEIGHT, $this->program->weight());
    }

    public function testAssociations()
    {
        $childName = 'child name';
        $mockParent = m::mock(Program::class);
        $mockChild = m::mock(Program::class, ['name' => $childName]);

        $mockChild->shouldReceive('setSupportedBy')->with($this->program);

        $this->assertSame($this->program, $this->program->setSupportedBy($mockParent));
        $this->assertSame($mockParent, $this->program->supportedBy());
        $this->assertNull($this->program->addToDisc($mockChild));
        $this->assertEquals([$childName => $mockChild], $this->program->disc());
    }

    public function test_totalWeight()
    {
        $childName = 'child name';
        $childWeight = 74;
        $mockParent = m::mock(Program::class);
        $mockChild = m::mock(Program::class, ['name' => $childName, 'totalWeight' => $childWeight]);

        $mockChild->shouldReceive('setSupportedBy')->with($this->program);

        $this->assertNull($this->program->addToDisc($mockChild));
        $this->assertEquals($childWeight + self::WEIGHT, $this->program->totalWeight());
    }
}
