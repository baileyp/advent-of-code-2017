<?php

namespace App\Solution;

use App\Solution\Day20\{Particle, ParticleSimulator, Vector};

class Day20Solution extends AbstractSolution
{
    public function part1(): string
    {
        $particles = array_map([$this, 'particleFromLine'], iterator_to_array($this->inputReader->readAll()));

        return (new ParticleSimulator(...$particles))->findClosestToHomeParticleId();
    }
    
    public function part2(): string
    {
        $particles = array_map([$this, 'particleFromLine'], iterator_to_array($this->inputReader->readAll()));

        return count((new ParticleSimulator(...$particles))->runAndDestroyCollisions());
    }

    /**
     * Convert a raw input line into a Particle
     *
     * @param string $line
     * @return Particle
     */
    private function particleFromLine(string $line): Particle
    {
        return new Particle(...array_map(function(string $vector): Vector {
            return new Vector(...array_map('intval', explode(',', substr($vector, 3, -1))));
        }, explode(', ', $line)));
    }
}
