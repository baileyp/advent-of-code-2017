<?php

namespace App\Solution;

class Day10Solution extends AbstractSolution
{
    const LIST_SIZE = 256;
    const SUFFIX_VALUES = [17, 31, 73, 47, 23];
    
    public function part1(): string
    {
        $lengths = $this->parseInput();
        $list = range(0, static::LIST_SIZE - 1);

        $currentPosition = 0;
        $skipSize = 0;

        $this->applyLengthReversals($list, $lengths, $currentPosition, $skipSize);

        return $list[0] * $list[1];
    }

    public function part2(): string
    {
        $lengths = array_merge($this->parseInputBytes(), static::SUFFIX_VALUES);
        $list = range(0, static::LIST_SIZE - 1);

        $currentPosition = 0;
        $skipSize = 0;

        for ($i = 0; $i < 64; $i++) {
            $this->applyLengthReversals($list, $lengths, $currentPosition, $skipSize);
        }

        $denseHash = $this->hashDense($list);

        return implode('', array_map(function(int $ord){
            return substr('0' . dechex($ord), -2);
        }, $denseHash));
    }

    /**
     * For each length provided in $lengths, reverse a sublist of $list based on that $length and positioning data
     *
     * This is mutator and directly modifies the provided list.
     *
     * @param array $list
     * @param array $lengths
     * @param int $currentPosition
     * @param int $skipSize
     */
    private function applyLengthReversals(array &$list, array $lengths, int &$currentPosition, int &$skipSize): void
    {
        foreach ($lengths as $length) {
            $this->reverseSublist($list, $currentPosition, $length);

            $currentPosition += $length + $skipSize;
            if ($currentPosition > static::LIST_SIZE) {
                $currentPosition = $currentPosition % static::LIST_SIZE;
            }

            $skipSize++;
        }
    }

    /**
     * Inside $list, identify a sublist bounded by $start and $length and reverse the items in that sublist. If either
     * bound of the sublist extends beyond the list's size, treat the list as circular and "wrap-around" to the other
     * side.
     *
     * This is mutator and directly modifies the provided list.
     *
     * @param array $list
     * @param int $start
     * @param int $length
     */
    private function reverseSublist(array &$list, int $start, int $length): void
    {
        $end = $start + $length - 1;
        if ($start >= static::LIST_SIZE) {
            $start = $start % static::LIST_SIZE;
        }
        if ($end >= static::LIST_SIZE) {
            $end = $end % static::LIST_SIZE;
        }
        for ($i = 0; $i < $length; $i += 2) {

            $temp = $list[$start];
            $list[$start] = $list[$end];
            $list[$end] = $temp;

            $start++;
            $end--;

            if ($end < 0) {
                $end = static::LIST_SIZE - 1;
            }

            if ($start >= static::LIST_SIZE) {
                $start = 0;
            }
        }
    }

    /**
     * Generate a dense hash from a sparse hash
     *
     * @param array $sparseHash
     * @return array
     */
    private function hashDense(array $sparseHash): array
    {
        return array_map(function(array $chunk){
            return array_reduce($chunk, function($carry, $item){
                return $carry ^ $item;
            });
        }, array_chunk($sparseHash, 16));
    }

    /**
     * Parse the input as a comma-separated list of integers
     *
     * @return array
     */
    private function parseInput(): array
    {
        return array_map('intval', explode(',', $this->inputReader->readLine()));
    }

    /**
     * Parse the input as a stream of bytes (in the ASCII range)
     *
     * @return array
     */
    private function parseInputBytes(): array
    {
        $input = $this->inputReader->readLine();
        return $input === '' ? [] : array_map('ord', str_split($input));
    }
}