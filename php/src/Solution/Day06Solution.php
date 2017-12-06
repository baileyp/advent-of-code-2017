<?php

namespace App\Solution;

class Day06Solution extends AbstractSolution
{
    public function part1(): string
    {
        $configsSeen = [];

        $banks = $this->getBanks();
        $config = $this->hash($banks);

        while (!array_key_exists($config, $configsSeen)) {
            $configsSeen[$config] = true;
            $this->redistribute($this->findLargestBank($banks), $banks);
            $config = $this->hash($banks);
        }

        return count($configsSeen);
    }

    public function part2(): string
    {
        $configsSeen = [];
        $loopSize = 0;

        $banks = $this->getBanks();
        $config = $this->hash($banks);

        while (!array_key_exists($config, $configsSeen)) {
            $configsSeen[$config] = $loopSize++;
            $this->redistribute($this->findLargestBank($banks), $banks);
            $config = $this->hash($banks);
        }

        return $loopSize - $configsSeen[$config];
    }

    /**
     * Evenly redistribute the blocks in a given bank across all banks
     *
     * @param int $bank
     * @param array $banks
     */
    public function redistribute(int $bank, array &$banks): void
    {
        $blocks = $banks[$bank];
        $banks[$bank++] = 0;

        $bankSize = count($banks);
        $evenDistribution = floor($blocks / $bankSize);
        $receiveRemainder = $blocks % $bankSize;

        for ($i = 0, $cursor = $bank; $i < $bankSize; $i++, $cursor++) {
            if ($cursor >= $bankSize) {
                $cursor = 0;
            }

            $banks[$cursor] += $evenDistribution;
            if ($i < $receiveRemainder) {
                $banks[$cursor]++;
            }
        }
    }

    /**
     * Find the index the bank with the most blocks
     *
     * @param array $banks
     * @return int
     */
    private function findLargestBank(array $banks): int
    {
        $index = 0;
        $blocks = 0;

        foreach ($banks as $key => $val) {
            if ($val > $blocks) {
                $index = $key;
                $blocks = $val;
            }
        }

        return $index;
    }

    /**
     * Convert an array of banks to a representative hash
     *
     * @param array $banks
     * @return string
     */
    private function hash(array $banks): string
    {
        return implode(',', $banks);
    }

    /**
     * Read the memory banks from the input
     *
     * @return array
     */
    private function getBanks(): array
    {
        return array_map('intval', explode("\t", $this->inputReader->readLine()));
    }
}