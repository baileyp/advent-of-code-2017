<?php

namespace App\Test;

use App\Model\InputReaderInterface;
use App\Solution;
use PHPUnit\Framework\TestCase;

use \ArrayIterator;
use \Mockery as m;

class SolutionTestCase extends TestCase
{
    /**
     * @var Solution\SolutionInterface
     */
    protected $solution;

    /**
     * @var \Mockery\MockInterface
     */
    protected $mockReader;

    public function setUp()
    {
        $solutionClass = str_replace(['Test', '\\\\'], ['', '\\'], static::class);

        $this->mockReader = m::mock(InputReaderInterface::class);
        $this->solution = new $solutionClass($this->mockReader);
    }

    public function tearDown()
    {
        unset($this->solution);
        unset($this->mockReader);

        m::close();
    }

    protected function expectReadAll(string $input = null)
    {
        $this->mockReader
            ->shouldReceive('readAll')
            ->once()
            ->andReturn(new ArrayIterator(explode("\n", $input ?? static::INPUT)));
    }

    protected function expectReadLine(string $input = null)
    {
        $this->mockReader
            ->shouldReceive('readLine')
            ->once()
            ->andReturn($input ?? static::INPUT);
    }
}