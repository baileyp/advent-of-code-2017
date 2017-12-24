<?php

namespace App\Test\Solution\Day22;

use App\Solution\Day19\Cursor;
use App\Solution\Day22\Grid;
use App\Solution\Day22\Virus;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class VirusTest extends TestCase
{
    /**
     * @var m\MockInterface
     */
    protected $mockGrid;

    /**
     * @var m\MockInterface
     */
    protected $mockLocation;

    public function setUp()
    {
        $this->mockGrid = m::mock(Grid::class);
        $this->mockLocation = m::mock(Cursor::class);
    }

    public function tearDown()
    {
        unset($this->mockLocation);
        unset($this->mockGrid);
    }

    public function test_move()
    {
        $direction = 'N';

        $this->mockLocation
            ->shouldReceive('move')
            ->once()
            ->with($direction)
            ->andReturnSelf();

        $virus = new Virus($this->mockLocation, $direction, $this->mockGrid);
        $this->assertNull($virus->move());
    }

    /**
     * @dataProvider dp_infect
     */
    public function test_infect(string $nodeValue, string $expectedValue)
    {
        $row = 1;
        $col = 2;
        $isInfected = $expectedValue === Grid::INFECTED;

        $this->mockLocation
            ->shouldReceive('row')
            ->once()
            ->andReturn($row);

        $this->mockLocation
            ->shouldReceive('col')
            ->once()
            ->andReturn($col);

        $this->mockGrid
            ->shouldReceive('readNode')
            ->once()
            ->with($row, $col)
            ->andReturn($nodeValue);

        $this->mockGrid
            ->shouldReceive('writeNode')
            ->once()
            ->with($row, $col, $expectedValue);

        $virus = new Virus($this->mockLocation, 'N', $this->mockGrid);

        $this->assertEquals($isInfected, $virus->infect());
    }

    public function dp_infect(): array
    {
        return [
            [Grid::CLEAN, Grid::INFECTED],
            [Grid::INFECTED, Grid::CLEAN],
        ];
    }

    /**
     * @dataProvider dp_decideAndTurn
     */
    public function test_decideAndTurn($payload, string $direction, string $expectedDirection)
    {
        $this->mockGrid
            ->shouldReceive('isInfected')
            ->once()
            ->with($this->mockLocation)
            ->andReturn($payload);

        $virusDirection = new \ReflectionProperty(Virus::class, 'direction');
        $virusDirection->setAccessible(true);

        $virus = new Virus($this->mockLocation, $direction, $this->mockGrid);

        $virus->decideAndTurn();

        $this->assertEquals($expectedDirection, $virusDirection->getValue($virus));
    }

    public function dp_decideAndTurn(): array
    {
        return [
            [true, 'N', 'E'],
            [false, 'N', 'W'],
            [true, 'W', 'N'],
            [false, 'W', 'S'],
        ];
    }
}
