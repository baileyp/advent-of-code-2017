<?php

namespace App\Test;

use App\Model\InputReaderInterface;
use App\Solution;
use PHPUnit\Framework\TestCase;
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
}