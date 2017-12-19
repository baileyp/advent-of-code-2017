<?php

namespace App\Solution;

use App\Solution\Day19\{Cursor, Diagram};

class Day19Solution extends AbstractSolution
{
    public function part1(): string
    {
        $map = array_map('str_split', iterator_to_array($this->inputReader->readAll()));
        $collectible = range('A', 'Z');

        $diagram = new Diagram($map, $collectible);

        $diagram->followPath(new Cursor(0, array_search('|', $map[0])), 'S');

        return implode('', $diagram->collection());
    }
    
    public function part2(): string
    {
        $map = array_map('str_split', iterator_to_array($this->inputReader->readAll()));
        $collectible = range('A', 'Z');

        $diagram = new Diagram($map, $collectible);

        return $diagram->followPath(new Cursor(0, array_search('|', $map[0])), 'S');
    }
}