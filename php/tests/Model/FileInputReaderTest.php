<?php

namespace App\Tests\Model;

use App\Model\FileInputReader;
use PHPUnit\Framework\TestCase;

class FileInputReaderTest extends TestCase
{
    const SINGLE_LINE_FILE = __DIR__ . '/../_data/single_line.txt';
    const MULTI_LINE_FILE = __DIR__ . '/../_data/multiple_lines.txt';

    public function tearDown()
    {
        @chmod(self::SINGLE_LINE_FILE, 0644);
    }

    public function testSingleLine()
    {
        $line = 'Readable Test File';
        $reader = new FileInputReader(self::SINGLE_LINE_FILE);

        $this->assertEquals($line, $reader->readLine());
        $this->assertNull($reader->readLine());
        $this->assertEquals([$line], iterator_to_array($reader->readAll()));
    }

    public function testMultiLine()
    {
        $line1 = 'Readable Test File';
        $line2 = 'With Multiple';
        $line3 = 'Lines';
        $reader = new FileInputReader(self::MULTI_LINE_FILE);

        $this->assertEquals($line1, $reader->readLine());
        $this->assertEquals($line2, $reader->readLine());
        $this->assertEquals($line3, $reader->readLine());
        $this->assertNull($reader->readLine());
        $this->assertEquals([$line1, $line2, $line3], iterator_to_array($reader->readAll()));
    }

    /**
     * @expectedException \LogicException
     */
    public function testNonFileThrowsLogicException()
    {
        new FileInputReader(dirname(self::SINGLE_LINE_FILE));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testNonReadableFile()
    {
        @chmod(self::SINGLE_LINE_FILE, 0111);
        new FileInputReader(self::SINGLE_LINE_FILE);
    }
}