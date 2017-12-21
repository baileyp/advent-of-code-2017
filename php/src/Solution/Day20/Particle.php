<?php

namespace App\Solution\Day20;

class Particle
{
    /**
     * @var Vector
     */
    private $position;

    /**
     * @var Vector
     */
    private $velocity;

    /**
     * @var Vector
     */
    private $acceleration;

    /**
     * Particle constructor.
     * @param Vector $position
     * @param Vector $velocity
     * @param Vector $acceleration
     */
    public function __construct(Vector $position, Vector $velocity, Vector $acceleration)
    {
        $this->position = $position;
        $this->velocity = $velocity;
        $this->acceleration = $acceleration;
    }

    /**
     * Get the position vector
     *
     * @return Vector
     */
    public function position(): Vector
    {
        return $this->position;
    }

    /**
     * Get the velocity vector
     *
     * @return Vector
     */
    public function velocity(): Vector
    {
        return $this->velocity;
    }

    /**
     * Get the acceleration vector
     *
     * @return Vector
     */
    public function acceleration(): Vector
    {
        return $this->acceleration;
    }

    /**
     * Move the particle according to its velocity and acceleration
     */
    public function move(): void
    {
        $this->velocity = $this->velocity->sum($this->acceleration);
        $this->position = $this->position->sum($this->velocity);
    }
}