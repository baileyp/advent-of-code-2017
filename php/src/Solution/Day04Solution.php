<?php

namespace App\Solution;

class Day04Solution extends AbstractSolution
{
    public function part1(): string
    {
        $numValid = 0;

        while ($line = $this->inputReader->readLine()) {
            $numValid += (int) $this->containsNoDuplicates($line);
        }

        return $numValid;
    }

    public function part2(): string
    {
        $numValid = 0;

        while ($line = $this->inputReader->readLine()) {
            $numValid += (int) $this->containsNoAnagrams($line);
        }

        return $numValid;
    }

    /**
     * Varify that no two words in the passphrase are duplicates
     *
     * @param string $passphrase
     * @return bool
     */
    private function containsNoDuplicates(string $passphrase): bool
    {
        $dictionary = [];

        foreach (explode(' ', $passphrase) as $word) {
            if (array_key_exists($word, $dictionary)) {
                return false;
            }
            $dictionary[$word] = true;
        }

        return true;
    }

    /**
     * Verify that no two words in the passphrase are anagrams of eachother
     *
     * @param string $passphrase
     * @return bool
     */
    private function containsNoAnagrams(string $passphrase): bool
    {
        $dictionary = [];

        foreach (explode(' ', $passphrase) as $word) {
            $canonicalWord = $this->canonicalize($word);
            if (array_key_exists($canonicalWord, $dictionary)) {
                return false;
            }
            $dictionary[$canonicalWord] = true;
        }

        return true;
    }

    /**
     * Convert a string into a canonical format where the characters are lexicographically sorted
     *
     * @param string $input
     * @return string
     */
    private function canonicalize(string $input): string
    {
        $chars = str_split($input);
        sort($chars);
        return implode('', $chars);
    }
}