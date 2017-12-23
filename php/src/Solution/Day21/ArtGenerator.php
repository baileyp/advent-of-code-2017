<?php

namespace App\Solution\Day21;

class ArtGenerator
{
    private $inputs = [];
    private $outputs = [];

    /**
     * ArtGenerator constructor.
     * @param array $enhancementRules
     */
    public function __construct(array $enhancementRules)
    {
        while (list($input, $output) = current($enhancementRules)) {
            $outputHash = (string)$output;
            $this->outputs[$outputHash] = $output;

            // Pre-cache all of the rotations and flips of each input matrix matched to an output matrix for fast
            // lookups while performing enhancements
            $inputRot90 = $input->rotate90();
            $inputRot180 = $inputRot90->rotate90();
            $inputRot270 = $inputRot180->rotate90();

            $this->inputs[(string)$input] = $outputHash;
            $this->inputs[(string)$inputRot90] = $outputHash;
            $this->inputs[(string)$inputRot180] = $outputHash;
            $this->inputs[(string)$inputRot270] = $outputHash;
            $this->inputs[(string)$input->flipVert()] = $outputHash;
            $this->inputs[(string)$inputRot90->flipVert()] = $outputHash;
            $this->inputs[(string)$inputRot180->flipVert()] = $outputHash;
            $this->inputs[(string)$inputRot270->flipVert()] = $outputHash;
            next($enhancementRules);
        }
    }

    /**
     * Given an initial drawing, generate a final drawing after processing it for $level iterations
     * @param string $initialDrawing
     * @param int $level
     * @return Matrix
     */
    public function generate(string $initialDrawing, int $level): Matrix
    {
        $matrix = Matrix::fromString($initialDrawing);

        ini_set('memory_limit','1G');
        for ($i = 1; $i <= $level; $i++) {
            $matrix = $this->iterate($matrix);
        }
        return $matrix;
    }

    /**
     * Create a new generation of the art
     *
     * @param Matrix $matrix
     * @return Matrix
     */
    private function iterate(Matrix $matrix)
    {
        $enhanced = array_map(function(array $row) {
            return array_map(function (Matrix $m) {
                return $this->outputs[$this->inputs[(string) $m]];
            }, $row);
        }, $matrix->split());

        return Matrix::merge($enhanced);
    }

    /**
     * Print the art. Pretty!
     *
     * @param Matrix $matrix
     */
    private function print(Matrix $matrix): void
    {
        foreach ($matrix as $row) {
            echo "\n", implode('', $row);
        }
    }
}