<?php

namespace App\Solution\Day20;

use \Countable;
use \LogicException;

class ParticleSimulator implements Countable
{
    /**
     * @var Particle[]|array
     */
    private $particles = [];

    /**
     * ParticleSimulator constructor.
     * @param Particle[] ...$particles
     */
    public function __construct(Particle ...$particles)
    {
        $this->particles = $particles;
    }

    /**
     * Run a simulation that "moves" the particles and determines which one stays closest to home and return its ID
     *
     * @return int
     */
    public function findClosestToHomeParticleId(): int
    {
        // Find the slowest acceleration value
        $minAcceleration = array_reduce($this->particles, function(float $carry, Particle $p) {
            return min($carry, $p->acceleration()->distance());
        }, PHP_INT_MAX);

        // Faster accelerating particles will always end up further out - remove them
        $this->particles = array_filter($this->particles, function(Particle $p) use ($minAcceleration) {
            return $p->acceleration()->distance() === $minAcceleration;
        });

        // Of the remaining, find the lowest velocity value
        $minVelocity = array_reduce($this->particles, function(float $carry, Particle $p) {
            return min($carry, $p->velocity()->distance());
        }, PHP_INT_MAX);

        // Faster moving particles will always end up further out, remove them
        $this->particles = array_filter($this->particles, function(Particle $p) use ($minVelocity) {
            return $p->velocity()->distance() === $minVelocity;
        });

        // All remaining particles have the same acceleration and velocity, so return the closest one
        $minDistance = array_reduce($this->particles, function(float $carry, Particle $p) {
            return min($carry, $p->position()->distance());
        }, PHP_INT_MAX);

        $this->particles = array_filter($this->particles, function(Particle $p) use ($minDistance) {
            return $p->position()->distance() === $minDistance;
        });

        if (count($this) !== 1) {
            throw new LogicException('Multiple particles stay equally close to home');
        }

        return key($this->particles);
    }

    /**
     * Run a simulation that "moves" all the particles and destroys any that collide
     *
     * @return ParticleSimulator
     */
    public function runAndDestroyCollisions(): ParticleSimulator
    {
        $this->destroyCollisions($this->buildCollisionMap());
        return $this;
    }

    /**
     * Compare every distinct pair of particles and determine if they ever collide. The returned map is keyed by
     * ticks and valued by an array of particles IDs that collide at that tick
     *
     * @return array
     */
    private function buildCollisionMap(): array
    {
        $collisionMap = [];

        for ($i = 0; $i < count($this->particles) - 1; $i++) {
            for ($j = $i + 1; $j < count($this->particles); $j++) {
                $atTick = $this->detectCollision($this->particles[$i], $this->particles[$j]);
                if (is_int($atTick)) {
                    $collisionMap[$atTick][$i] = true;
                    $collisionMap[$atTick][$j] = true;
                }
            }
        }

        return $collisionMap;
    }

    /**
     * Detect if the two particles will ever collide. If they will, return the tick at which the collision occurs.
     *
     * @param Particle $one
     * @param Particle $two
     * @return int|null
     */
    private function detectCollision(Particle $one, Particle $two): ?int
    {
        $one = clone $one;
        $two = clone $two;

        $currentDistance = $one->position()->distance($two->position());
        $tick = 0;
        do {
            if ($currentDistance === 0.0) {
                return $tick;
            }
            $one->move();
            $two->move();
            $tick++;

            $newDistance = $one->position()->distance($two->position());

            if ($newDistance > $currentDistance) {
                // Particles are diverging, bail out
                break;
            }

            // Particles are converging, keep going
            $currentDistance = $newDistance;
        } while (true);

        return null;
    }

    /**
     * Use the provided collision map to destroy particles that collide. Perform the destructions chronologically
     *
     * @param array $collisionMap
     */
    private function destroyCollisions(array $collisionMap): void
    {
        // TODO Can this be done better without having to sort the map by ticks?
        ksort($collisionMap);
        while (count($collisionMap)) {
            $collidingIds = array_keys(array_shift($collisionMap));
            // The collision map is altered during this process, so collisions at a given tick might be negated if one
            // of the particles was destroyed in an earlier tick. Therefore, if a map entry contains zero or one
            // particles, the collision is no longer valid and we can skip it.
            if (count($collidingIds) <= 1) {
                continue;
            }
            array_walk($collidingIds, function(int $particleId) use (&$collisionMap) {
                // Destroy the particle
                unset($this->particles[$particleId]);

                // Now remove it from other places where it might appear in the collision map
                array_walk($collisionMap, function(array $ids) use ($particleId) {
                    unset($ids[$particleId]);
                });
            });
        }
    }

    /**
     * Return how many particles are in this simulator
     *
     * Implementation of \Countable::count()
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->particles);
    }
}