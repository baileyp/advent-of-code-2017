<?php

namespace App\Solution;

use App\Solution\Day07\{Program, Tower};

class Day07Solution extends AbstractSolution
{
    public function part1(): string
    {
        return $this->buildTower()->base()->name();
    }

    public function part2(): string
    {
        return $this->buildTower()->findImbalance();
    }

    private function buildTower(): Tower
    {
        $tower = new Tower();
        $associations = [];

        foreach ($this->inputReader->readAll() as $row) {
            list($program, $children) = $this->parseLine($row);
            $tower->addProgram($program);

            if (count($children)) {
                $associations[$program->name()] = $children;
            }
        }

        foreach ($associations as $name => $children) {
            $tower->writeProgramsToDisc($name, ...$children);
        }

        return $tower;
    }

    private function parseLine(string $line): array
    {
        $definition = explode(' -> ', $line);

        $node = $definition[0];
        $children = $definition[1] ?? '';

        $name = substr($node, 0, strpos($node, ' '));
        $weight = (int)substr($node, strpos($node, '(') + 1, -1);

        $children = $children ? explode(', ', $children) : [];

        return [new Program($name, $weight), $children];
    }
}