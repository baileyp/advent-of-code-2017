<?php

namespace App\Solution;

class Day09Solution extends AbstractSolution
{
    public function part1(): string
    {
        $input = $this->inputReader->readLine();

        $score = 0;
        $groupDepth = 0;
        $inGarbage = false;

        for ($i = 0; $i < strlen($input); $i++) {
            switch ($input{$i}) {
                case '!':
                    $i++;
                    break;
                case '{':
                    if (!$inGarbage) {
                        $groupDepth++;
                    }
                    break;
                case '}':
                    if (!$inGarbage) {
                        $score += $groupDepth;
                        $groupDepth--;
                    }
                    break;
                case '<':
                    if (!$inGarbage) {
                        $inGarbage = true;
                    }
                    break;
                case '>':
                    if ($inGarbage) {
                        $inGarbage = false;
                    }
                    break;
                default:
                    // Nothing
            }
        }

        return (string) $score;
    }
    
    public function part2(): string
    {
        $input = $this->inputReader->readLine();

        $garbageCount = 0;
        $groupDepth = 0;
        $inGarbage = false;

        for ($i = 0; $i < strlen($input); $i++) {
            switch ($input{$i}) {
                case '!':
                    $i++;
                    break;
                case '{':
                    if (!$inGarbage) {
                        $groupDepth++;
                    } else {
                        $garbageCount++;
                    }
                    break;
                case '}':
                    if (!$inGarbage) {
                        $groupDepth--;
                    } else {
                        $garbageCount++;
                    }
                    break;
                case '<':
                    if (!$inGarbage) {
                        $inGarbage = true;
                    } else {
                        $garbageCount++;
                    }
                    break;
                case '>':
                    if ($inGarbage) {
                        $inGarbage = false;
                    } else {
                        $garbageCount++;
                    }
                    break;
                default:
                    if ($inGarbage) {
                        $garbageCount++;
                    }
            }
        }

        return (string) $garbageCount;
    }
}