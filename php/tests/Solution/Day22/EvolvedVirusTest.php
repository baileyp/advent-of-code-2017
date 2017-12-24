<?php

namespace App\Test\Solution\Day22;

use App\Solution\Day22\Grid;
use App\Solution\Day22\EvolvedVirus;
use PHPUnit\Framework\TestCase;

class EvolvedVirusTest extends VirusTest
{
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

        $this->mockGrid
            ->shouldReceive('isInfected')
            ->once()
            ->with($this->mockLocation)
            ->andReturn($isInfected);

        $virus = new EvolvedVirus($this->mockLocation, 'N', $this->mockGrid);

        $this->assertEquals($isInfected, $virus->infect());
    }

    public function dp_infect(): array
    {
        return [
            [Grid::CLEAN, Grid::WEAKENED],
            [Grid::WEAKENED, Grid::INFECTED],
            [Grid::INFECTED, Grid::FLAGGED],
            [Grid::FLAGGED, Grid::CLEAN],
        ];
    }

    /**
     * @dataProvider dp_decideAndTurn
     */
    public function test_decideAndTurn($payload, string $direction, string $expectedDirection)
    {
        $row = 1;
        $col = 2;

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
            ->andReturn($payload);

        $virusDirection = new \ReflectionProperty(EvolvedVirus::class, 'direction');
        $virusDirection->setAccessible(true);

        $virus = new EvolvedVirus($this->mockLocation, $direction, $this->mockGrid);

        $virus->decideAndTurn();

        $this->assertEquals($expectedDirection, $virusDirection->getValue($virus));
    }

    public function dp_decideAndTurn(): array
    {
        return [
            [Grid::CLEAN, 'N', 'W'],
            [Grid::INFECTED, 'N', 'E'],
            [Grid::FLAGGED, 'N', 'S'],
            [Grid::WEAKENED, 'N', 'N'],
        ];
    }
}
