<?php

namespace App\Solution;

use App\Solution\Day22\EvolvedVirus;
use App\Solution\Day22\Grid;
use App\Solution\Day22\Virus;

class Day22Solution extends AbstractSolution
{
    public function part1(int $bursts = 10000): string
    {
        $nodes = array_map('str_split', iterator_to_array($this->inputReader->readAll()));
        $grid = new Grid($nodes);

        $virus = new Virus($grid->middle(), 'N', $grid);
        $numInfections = 0;

        for ($burst = 0; $burst < $bursts; $burst++) {
            $virus->decideAndTurn();
            $numInfections += (int) $virus->infect();
            $virus->move();
        }

        return $numInfections;
    }
    
    public function part2(int $bursts = 10000000): string
    {
        $nodes = array_map('str_split', iterator_to_array($this->inputReader->readAll()));
        $grid = new Grid($nodes);

        $virus = new EvolvedVirus($grid->middle(), 'N', $grid);
        $numInfections = 0;

        for ($burst = 0; $burst < $bursts; $burst++) {
            $virus->decideAndTurn();
            $numInfections += (int) $virus->infect();
            $virus->move();
        }

        return $numInfections;
    }
}