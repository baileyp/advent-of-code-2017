<?php

namespace App\Solution;

use App\Solution\Day13\{Firewall, Layer};

class Day13Solution extends AbstractSolution
{
    public function part1(): string
    {
        return $this->getSeverity($this->buildFirewall());
    }
    
    public function part2(): string
    {
        $firewall = $this->buildFirewall();
        $delay = 0;

        while ($this->isCaught($firewall, $delay)) {
            $delay++;
        }

        return $delay;
    }

    /**
     * Simulate sending a packet across the firewall and determine if it is ever caught in a layer. Optionally specify
     * a delay in picoseconds to wait before sending the packet
     *
     * @param array $firewall
     * @param int $delay
     * @return bool
     */
    private function isCaught(array $firewall, int $delay = 0): bool
    {
        foreach ($firewall as $depth => $layer) {
            if ($layer->scannerPositionAfterTime($depth + $delay) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Simulate sending a packet across the firewall and calculate the severity of its journey
     *
     * @param array $firewall
     * @return int
     */
    private function getSeverity(array $firewall): int
    {
        $severity = 0;

        foreach ($firewall as $depth => $layer) {
            if ($layer->scannerPositionAfterTime($depth) === 0) {
                $severity += $depth * $layer->range();
            }
        }

        return $severity;
    }

    /**
     * Build a firewall from the input
     *
     * @return array
     */
    private function buildFirewall(): array
    {
        $firewall = [];

        foreach ($this->inputReader->readAll() as $line) {
            list($layer, $range) = array_map('intval', explode(': ', $line));
            $firewall[$layer] = new Layer($range);
        }

        return $firewall;
    }
}