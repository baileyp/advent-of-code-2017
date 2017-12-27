<?php

namespace App\Solution;

use App\Solution\Day25\TuringMachine;

class Day25Solution extends AbstractSolution
{
    public function part1(): string
    {
        $input = iterator_to_array($this->inputReader->readAll());

        $startingState = substr(array_shift($input), -2, 1);
        $numSteps = (int) preg_replace("/\D/", '', array_shift($input));

        $machine = new TuringMachine($startingState);

        $subPattern = "is ([01]).*value ([01]).*the (right|left).*state ([A-Z])";
        $pattern = "/.*state ([A-Z]).*$subPattern.*$subPattern/U";

        if (preg_match_all($pattern, implode(' ', $input), $matches)) {
            for ($i = 0; $i < count($matches[0]); $i++) {
                $machine->putState(
                    $matches[1][$i],
                    (int) $matches[2][$i],
                    (int) $matches[3][$i],
                    $matches[4][$i],
                    $matches[5][$i],
                    (int) $matches[6][$i],
                    (int) $matches[7][$i],
                    $matches[8][$i],
                    $matches[9][$i]
                );
            }
        }

        $machine->run($numSteps);

        return $machine->diagnosticChecksum();
    }
    
    public function part2(): string
    {
        return "Clink the link!";
    }
}