<?php

namespace App\Solution;

use App\Solution\Day18\Duet;
use App\Solution\Day18\DuetProgram;

class Day18Solution extends AbstractSolution
{
    public function part1(): string
    {
        $duet = new Duet(iterator_to_array($this->inputReader->readAll()));

        $duet->play();

        return $duet->recover();
    }
    
    public function part2(): string
    {
        $instructions = iterator_to_array($this->inputReader->readAll());

        $program0 = new DuetProgram($instructions, '0');
        $program1 = new DuetProgram($instructions, '1');

        $program0->duetWith($program1);
        $program1->duetWith($program0);

        $program0->play();
        $program1->play();

        return count($program1);
    }
}

