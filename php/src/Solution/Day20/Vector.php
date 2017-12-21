<?php

namespace App\Solution\Day20;

class Vector
{
    private $x;
    private $y;
    private $z;

    /**
     * Vector constructor.
     * @param int $x
     * @param int $y
     * @param int $z
     */
    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * String representation of this vector - useful for hashing
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s,%s,%s", $this->x, $this->y, $this->z);
    }

    /**
     * X-axis value
     *
     * @return int
     */
    public function x(): int
    {
        return $this->x;
    }

    /**
     * Y-axis value
     *
     * @return int
     */
    public function y(): int
    {
        return $this->y;
    }

    /**
     * Z-axis value
     *
     * @return int
     */
    public function z(): int
    {
        return $this->z;
    }

    /**
     * Create a new vector that is the some of this one plus $vector
     *
     * @param Vector $vector
     * @return Vector
     */
    public function sum(Vector $vector)
    {
        return new self($this->x + $vector->x(), $this->y + $vector->y(), $this->z + $vector->z());
    }

    /**
     * Find the Euclidean distance between this vector an another one, or the Manhattan distance between this vector and <0, 0, 0>
     *
     * @param Vector|null $from
     * @return float
     */
    public function distance(Vector $from = null): float
    {
        if (null === $from) {
            return abs($this->x()) + abs($this->y()) + abs($this->z());
        }

        $x1 = $from->x();
        $y1 = $from->y();
        $z1 = $from->z();

        $x2 = $this->x();
        $y2 = $this->y();
        $z2 = $this->z();

        return sqrt(($x2 - $x1) ** 2 + ($y2 - $y1) ** 2 + ($z2 - $z1) ** 2);
    }
}