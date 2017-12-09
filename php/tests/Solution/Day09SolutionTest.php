<?php

namespace App\Test\Solution;

use App\Test\SolutionTestCase;

class Day09SolutionTest extends SolutionTestCase
{
    const INPUT = '';

    /**
     * @dataProvider dp_part1
     */
    public function test_part1(string $input, string $result)
    {
        $this->expectReadLine($input);
        $this->assertEquals($result, $this->solution->part1());
    }

    public function dp_part1()
    {
        return [
            ['{}', '1'],
            ['{{{}}}', '6'],
            ['{{},{}}', '5'],
            ['{{{},{},{{}}}}', '16'],
            ['{<a>,<a>,<a>,<a>}', '1'],
            ['{{<ab>},{<ab>},{<ab>},{<ab>}}', '9'],
            ['{{<!!>},{<!!>},{<!!>},{<!!>}}', '9'],
            ['{{<a!>},{<a!>},{<a!>},{<ab>}}', '3'],
        ];
    }

    /**
     * @dataProvider dp_part2
     */
    public function test_part2(string $input, string $result)
    {
        $this->expectReadLine($input);
        $this->assertEquals($result, $this->solution->part2());
    }

    public function dp_part2()
    {
        return [
            ['<>', '0'],
            ['<random characters>', '17'],
            ['<<<<>', '3'],
            ['<{!>}>', '2'],
            ['<!!>', '0'],
            ['<!!!>>', '0'],
            ['<{o"i!a,<{i<a>', '10'],
        ];
    }
}