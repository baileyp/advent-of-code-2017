<?php

namespace App\Solution;

use App\Solution\Day21\{ArtGenerator, Matrix};

class Day21Solution extends AbstractSolution
{
    public function part1(int $numIterations = 5): string
    {
        $art = new ArtGenerator(array_map(
            [$this, 'lineToEnhancementRule'],
            iterator_to_array($this->inputReader->readAll())
        ));

        $final = $art->generate(".#./..#/###", $numIterations);
        return count($final);
    }
    
    public function part2(): string
    {
        return $this->part1(18);
    }

    private function lineToEnhancementRule(string $line): array
    {
        return array_map([Matrix::class, 'fromString'], explode(' => ', $line));
    }
}
