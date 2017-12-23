<?php

namespace App\Solution\Day21;

use \ArrayIterator;
use \Countable;
use \IteratorAggregate;

class Matrix implements IteratorAggregate, Countable
{
    /**
     * @var array
     */
    private $matrix = [];

    /**
     * Matrix constructor.
     * @param array $matrix
     */
    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    /**
     * String representation of this matrix
     *
     * @return string
     */
    public function __toString()
    {
        return implode('/', array_map(function(array $row) {
            return implode('', $row);
        }, $this->matrix));
    }

    /**
     * Reverse of __toString()
     *
     * @param string $string
     * @return Matrix
     */
    public static function fromString(string $string): Matrix
    {
        return new self(array_map('str_split', explode('/', $string)));
    }

    /**
     * Merge a grid of Matrices into a new, single Matrix. Reverse of Matrix::split()
     *
     * @param array $matrices
     * @return Matrix
     */
    public static function merge(array $matrices): Matrix
    {
        $merged = [];

        foreach ($matrices as $mRow => $mCols) {
            foreach ($mCols as $mCol => $matrix) {
                foreach ($matrix as $row => $cols) {
                    $width = count($cols);
                    foreach ($cols as $col => $value) {
                        $merged[$mRow * $width + $row][$mCol * $width + $col] = $value;
                    }
                }
            }
        }

        return new Matrix($merged);
    }

    /**
     * Split this Matrix into a grid of Matrices that are either 2x2 or 3x3 in size.
     *
     * @return array
     */
    public function split(): array
    {
        $width = count($this->matrix[0]);
        $height = count($this->matrix);
        $newMatrices = [];

        if ($width % 2 == 0) {
            $size = 2;
        }
        elseif ($width % 3 === 0) {
            $size = 3;
        } else {
            return [$this];
        }

        for ($row = 0; $row < $height; $row += $size) {
            for ($col = 0; $col < $width; $col += $size) {
                $matrix = [];

                for ($mRow = 0; $mRow < $size; $mRow++) {
                    for ($mCol = 0; $mCol < $size; $mCol++) {
                        $matrix[$mRow][$mCol] = $this->matrix[$row + $mRow][$col + $mCol];
                    }
                }

                $newMatrices[$row/$size][$col/$size] = new Matrix($matrix);
            }
        }

        return $newMatrices;
    }

    /**
     * Return a new Matrix that represents this one rotate 90 degrees clockwise
     *
     * @return Matrix
     */
    public function rotate90(): Matrix
    {
        $width = count($this->matrix[0]);
        $height = count($this->matrix);

        $rotated = array_fill(0, $width, array_fill(0, $height, null));

        foreach ($this->matrix as $row => $cols) {
            foreach ($cols as $col => $value) {
                $rotated[$col][$height - $row - 1] = $value;
            }
        }

        return new self($rotated);
    }

    /**
     * Return a new Matrix that represents this one flipped vertically
     *
     * @return Matrix
     */
    public function flipVert(): Matrix
    {
        return new self(array_reverse($this->matrix));
    }

    /**
     * Count the number of "on" pixels in the matrix
     *
     * Implementation of \Countable::count();
     *
     * @return int
     */
    public function count(): int
    {
        $count = 0;
        foreach ($this as $row) {
            foreach ($row as $value) {
                if ('#' === $value) {
                    $count++;
                }
            }
        }
        return $count;
    }

    /**
     * Allow for iteration of the underlying values
     *
     * Implementation of \IteratorAggregate::getIterator()
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->matrix);
    }
}