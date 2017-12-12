<?php

namespace App\Solution;

use \SplQueue;

class Day12Solution extends AbstractSolution
{
    public function part1(): string
    {
        $graph = $this->fetchGraph();

        return $this->bfsCount($graph, '0');
    }

    public function part2(): string
    {
        $graph = $this->fetchGraph();

        $visitedNodes = [];
        $groupCount = 0;

        foreach (array_keys($graph) as $root) {
            if (!array_key_exists($root, $visitedNodes)) {
                foreach ($this->bfsFlatten($graph, $root) as $unique) {
                    $visitedNodes[$unique] = true;
                }
                $groupCount++;
            }
        }

        return $groupCount;
    }

    /**
     * Use BFS to count the nodes starting at $root
     *
     * @param array $graph
     * @param string $root
     * @return int
     */
    private function bfsCount(array $graph, string $root)
    {
        $queue = new SplQueue();
        $queue->enqueue($root);
        $visited[$root] = true;
        $count = 1;

        while ($queue->count() > 0) {
            $node = $queue->dequeue();
            foreach ($graph[$node] as $neighbor) {
                if (!array_key_exists($neighbor, $visited)) {
                    $count++;
                    $visited[$neighbor] = true;

                    $queue->enqueue($neighbor);
                }
            }
        }

        return $count;
    }

    /**
     * Use BFS to flatten a graph into a unique list of nodes
     *
     * @param array $graph
     * @param string $root
     * @return array
     */
    private function bfsFlatten(array $graph, string $root)
    {
        $queue = new SplQueue();
        $queue->enqueue($root);
        $visited[$root] = true;

        while ($queue->count() > 0) {
            $node = $queue->dequeue();
            foreach ($graph[$node] as $neighbor) {
                if (!array_key_exists($neighbor, $visited)) {
                    $visited[$neighbor] = true;

                    $queue->enqueue($neighbor);
                }
            }
        }

        return array_keys($visited);
    }

    /**
     * Fetch the graph from the input as an adjacency list
     *
     * @return array
     */
    private function fetchGraph(): array
    {
        $graph = [];

        foreach ($this->inputReader->readAll() as $line) {
            list($root, $neighbors) = $this->parseLine($line);

            $graph[$root] = $neighbors;
        }

        return $graph;
    }

    /**
     * Parse an input line into node =>
     * @param string $line
     * @return array
     */
    private function parseLine(string $line): array
    {
        list ($program, $connected) = explode(' <-> ', $line);

        return [(int) $program, explode(', ', $connected)];
    }
}