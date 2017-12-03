<?php

namespace App\Test\Model;

use App\Model\StdinReader;
use PHPUnit\Framework\TestCase;

class StdinReaderTest extends TestCase
{
    public function testSingleLine()
    {
        $line = 'test input';
        $reader = new StdinReader($line);

        $this->assertSame($line, $reader->readLine());
        $this->assertNull($reader->readLine());
        $this->assertSame([$line], iterator_to_array($reader->readAll()));
    }

    public function testMultiLine()
    {
        $line1 = 'first line';
        $line2 = 'second line';

        $input = $line1 . PHP_EOL . $line2;

        $reader = new StdinReader($input);

        $this->assertSame($line1, $reader->readLine());
        $this->assertSame($line2, $reader->readLine());
        $this->assertNull($reader->readLine());

        $this->assertSame([$line1, $line2], iterator_to_array($reader->readAll()));
    }
}
