<?php

namespace App\Solution;

class Day16Solution extends AbstractSolution
{
    const HIGH_PROGRAM = 'p';
    private $programs;

    public function part1(): string
    {
        $moves = $this->learnMoves(explode(',', $this->inputReader->readLine()));

        foreach ($moves['move'] as $move) {
            call_user_func($move);
        }
        foreach ($moves['rename'] as $rename) {
            call_user_func($rename);
        }

        return implode('', $this->programs);
    }
    
    public function part2(): string
    {
        list($moveTransform, $partnerTransform) = $this->learnDance(explode(',', $this->inputReader->readLine()));

        $initialState = implode(',', $this->programs);

        // Find cycle size i.e., how many iterations before we encounter the initial state again
        $cycleSize = 0;
        do {
            $this->applyMoveTransform($moveTransform);
            $this->applyRenameTransform($partnerTransform);
            $cycleSize++;
        }
        while (implode(',', $this->programs) !== $initialState);

        // Now apply just enough iterations for the remainder of the input after removing the cycle size
        for ($i = 0; $i < 1e9 % $cycleSize; $i++) {
            $this->applyMoveTransform($moveTransform);
            $this->applyRenameTransform($partnerTransform);
        }

        return implode('', $this->programs);
    }

    /**
     * From raw instructions of dance moves, convert them into callables that execute the move itself
     *
     * @param array $moves
     * @return array
     */
    private function learnMoves(array $moves): array
    {
        $this->reset();
        $learned = ['move' => [], 'rename' => []];
        foreach ($moves as $move) {
            if (preg_match("/^s(\d+)/", $move, $matches)) {
                $learned['move'][] = function() use ($matches) {
                    $this->spin((int) $matches[1]);
                };
            }
            elseif (preg_match("/^x(\d+)\/(\d+)/", $move, $matches)) {
                $learned['move'][] = function() use ($matches) {
                    $this->exchange((int) $matches[1], $matches[2]);
                };
            }
            elseif (preg_match("/^p([a-p])\/([a-p])/", $move, $matches)) {
                $learned['rename'][] = function () use ($matches) {
                    $this->partner($matches[1], $matches[2]);
                };
            }
        }
        return $learned;
    }

    /**
     * Learn the dance (i.e., the move and rename transforms) from the raw move data
     *
     * @return array
     */
    private function learnDance(array $moves): array
    {
        $moves = $this->learnMoves($moves);
        $startingPosition = $this->programs;

        foreach ($moves['move'] as $move) {
            call_user_func($move);
        }
        $moveTransform = $this->learnMoveTransform($startingPosition, $this->programs);
        $this->reset();

        foreach ($moves['rename'] as $rename) {
            call_user_func($rename);
        }
        $renameTransform = $this->learnRenameTransform($startingPosition, $this->programs);
        $this->reset();

        return [$moveTransform, $renameTransform];
    }

    /**
     * Reset the programs to their initial, pre-dance state
     */
    private function reset(): void
    {
        $this->programs = range('a', static::HIGH_PROGRAM);
    }

    /**
     * Learn the index changes between the $before and $after state of the programs
     *
     * @param array $before
     * @param array $after
     * @return array
     */
    private function learnMoveTransform(array $before, array $after): array
    {
        $wholeDance = [];
        foreach ($before as $position => $program) {
            $wholeDance[array_search($program, $after)] = $position;
        }
        ksort($wholeDance);
        return $wholeDance;
    }

    /**
     * Apply a move transform
     *
     * @param array $transform
     *
     * @see learnMoveTransform()
     */
    private function applyMoveTransform(array $transform): void
    {
        $transformed = [];
        foreach ($transform as $to => $from) {
            $transformed[$to] = $this->programs[$from];
        }
        $this->programs = $transformed;
    }

    /**
     * Learn the value changes between the $before and $after state of the programs
     *
     * @param array $before
     * @param array $after
     * @return array
     */
    private function learnRenameTransform(array $before, array $after): array
    {
        $wholeDance = [];
        foreach ($before as $position => $program) {
            $wholeDance[$program] = $after[$position];
        }
        return $wholeDance;
    }

    /**
     * Apply a rename transform
     *
     * @param array $transform
     *
     * @see learnRenameTransform()
     */
    private function applyRenameTransform(array $transform): void
    {
        $transformed = [];
        $map = array_flip($this->programs);
        foreach ($transform as $a => $b)
        {
            $transformed[$map[$a]] = $b;
        }
        ksort($transformed);
        $this->programs = $transformed;
    }

    /**
     * Remove $quantity programs from the end and put them at the beginning
     *
     * @param int $quantity
     */
    private function spin(int $quantity): void
    {
        while ($quantity) {
            array_unshift($this->programs, array_pop($this->programs));
            $quantity--;
        }
    }

    /**
     * Swap the locations of programs at indexes $a and $b
     *
     * @param int $a
     * @param int $b
     */
    private function exchange(int $a, int $b): void
    {
        $temp = $this->programs[$a];
        $this->programs[$a] = $this->programs[$b];
        $this->programs[$b] = $temp;
    }

    /**
     * Swap the locations of programs $a and $b
     *
     * @param string $a
     * @param string $b
     */
    private function partner(string $a, string $b): void
    {
        $this->exchange(array_search($a, $this->programs), array_search($b, $this->programs));
    }
}