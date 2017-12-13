<?php

namespace App\Solution\Day13;

/**
 * Simple simulation of a firewall layer
 */
class Layer
{
    /**
     * @var int
     */
    private $range = 0;

    /**
     * @var int
     */
    private $cycleSize;

    /**
     * Layer constructor.
     * @param int $range
     */
    public function __construct(int $range)
    {
        $this->range = $range;
        $this->cycleSize = $range === 1 ? $range : ($range - 1) * 2;
    }

    /**
     * Get the range of this layer
     *
     * @return int
     */
    public function range(): int
    {
        return $this->range;
    }

    /**
     * Determine where the scanner is on this layer after $picoseconds have elapsed
     *
     * @param int $picoSeconds
     * @return int
     */
    public function scannerPositionAfterTime(int $picoSeconds): int
    {
        $position = $picoSeconds % $this->cycleSize;
        if ($position > $this->range - 1) {
            $position = $this->cycleSize - $position;
        }
        return $position;
    }

}