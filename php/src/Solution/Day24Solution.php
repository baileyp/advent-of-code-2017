<?php

namespace App\Solution;

use \Generator;

class Day24Solution extends AbstractSolution
{
    public function part1(): string
    {
        $ports = $this->readPorts();
        $strongestBridge = 0;

        foreach ($this->findBridges($ports) as $bridge) {
            $strongestBridge = max($this->strength($bridge), $strongestBridge);
        }

        return $strongestBridge;
    }

    public function part2(): string
    {
        $ports = $this->readPorts();
        $strongestBridge = 0;
        $strongestBridgeLength = 0;

        foreach ($this->findBridges($ports) as $bridge) {
            if (count($bridge) < $strongestBridgeLength) {
                continue;
            }
            $strongestBridge = max($this->strength($bridge), $strongestBridge);
            $strongestBridgeLength = count($bridge);
        }

        return $strongestBridge;
    }

    /**
     * Read the raw input into an array of ports, which themselves are arrays
     *
     * @return array
     */
    private function readPorts(): array
    {
        return array_map(function(string $line) {
            return array_map('intval', explode('/', $line));
        }, iterator_to_array($this->inputReader->readAll()));
    }

    /**
     * Calculate the strength of a bridge
     *
     * @param array $bridge
     * @return int
     */
    private function strength(array $bridge): int
    {
        return array_sum(array_map('array_sum', $bridge));
    }

    /**
     * Recursively find valid bridges from the available $ports
     *
     * @param array $ports      The available pool of ports for making connections
     * @param array $bridge     The current bridge
     * @param int   $pins       The exposed pins that can receive a connection
     *
     * @return Generator
     */
    private function findBridges(array $ports, $bridge = [], int $pins = 0): Generator
    {
        foreach ($ports as $i => $port) {
            if ($port[0] === $pins || $port[1] === $pins) {
                $availablePorts = $ports;
                unset($availablePorts[$i]);
                $bridge[] = $port;

                $newPins = $pins == $port[0] ? $port[1] : $port[0];
                foreach ($this->findBridges($availablePorts, $bridge, $newPins) as $bridge) {
                    yield $bridge;
                }
                array_pop($bridge);
            }
        }

        yield $bridge;
    }
}
