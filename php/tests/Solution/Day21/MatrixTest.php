<?php

namespace App\Test\Solution\Day21;

use App\Solution\Day21\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{
    public function testBasics()
    {
        $asString = "12#/4#6/#89";
        $matrix = Matrix::fromString($asString);

        $this->assertCount(3, $matrix);
        $this->assertInstanceOf(\Iterator::class, $matrix->getIterator());
        $this->assertEquals($asString, (string) $matrix);
    }

    public function testTransformations()
    {
        $matrix = Matrix::fromString("12/34");

        $this->assertEquals("31/42", $matrix->rotate90());
        $this->assertEquals("34/12", $matrix->flipVert());
    }

    public function test_split()
    {
        $matrix = Matrix::fromString(implode('/', [
            "ABCDEFGHI",
            "123456789",
            "abcdefghi",
            "987654321",
            "JKLMNOPQR",
            "jklmnopqr",
            "STUVWXYZ-",
            "stuvwxyz+",
            "!@#$%^&*(",
        ]));

        $split = $matrix->split();

        $this->assertCount(3, $split);
        array_walk($split, function(array $row) {
            $this->assertCount(3, $row);
            $this->assertContainsOnly(Matrix::class, $row);
        });

        $expected = [
            [
                [['A', 'B', 'C'], ['1', '2', '3'], ['a', 'b', 'c']],
                [['D', 'E', 'F'], ['4', '5', '6'], ['d', 'e', 'f']],
                [['G', 'H', 'I'], ['7', '8', '9'], ['g', 'h', 'i']],
            ],
            [
                [['9', '8', '7'], ['J', 'K', 'L'], ['j', 'k', 'l']],
                [['6', '5', '4'], ['M', 'N', 'O'], ['m', 'n', 'o']],
                [['3', '2', '1'], ['P', 'Q', 'R'], ['p', 'q', 'r']],
            ],
            [
                [['S', 'T', 'U'], ['s', 't', 'u'], ['!', '@', '#']],
                [['V', 'W', 'X'], ['v', 'w', 'x'], ['$', '%', '^']],
                [['Y', 'Z', '-'], ['y', 'z', '+'], ['&', '*', '(']],
            ]
        ];

        foreach ($expected as $row => $matrices) {
            foreach ($matrices as $col => $matrix) {
                $this->assertSame($matrix, iterator_to_array($split[$row][$col]));
            }
        }
    }

    public function test_merge()
    {
        $input = [
            [
                new Matrix([['A', 'B', 'C'], ['1', '2', '3'], ['a', 'b', 'c']]),
                new Matrix([['D', 'E', 'F'], ['4', '5', '6'], ['d', 'e', 'f']]),
                new Matrix([['G', 'H', 'I'], ['7', '8', '9'], ['g', 'h', 'i']]),
            ],
            [
                new Matrix([['9', '8', '7'], ['J', 'K', 'L'], ['j', 'k', 'l']]),
                new Matrix([['6', '5', '4'], ['M', 'N', 'O'], ['m', 'n', 'o']]),
                new Matrix([['3', '2', '1'], ['P', 'Q', 'R'], ['p', 'q', 'r']]),
            ],
            [
                new Matrix([['S', 'T', 'U'], ['s', 't', 'u'], ['!', '@', '#']]),
                new Matrix([['V', 'W', 'X'], ['v', 'w', 'x'], ['$', '%', '^']]),
                new Matrix([['Y', 'Z', '-'], ['y', 'z', '+'], ['&', '*', '(']]),
            ]
        ];

        $merged = Matrix::merge($input);

        $expected = Matrix::fromString(implode('/', [
            "ABCDEFGHI",
            "123456789",
            "abcdefghi",
            "987654321",
            "JKLMNOPQR",
            "jklmnopqr",
            "STUVWXYZ-",
            "stuvwxyz+",
            "!@#$%^&*(",
        ]));

        $this->assertEquals($expected, $merged);
    }
}
