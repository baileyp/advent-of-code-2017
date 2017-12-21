<?php

namespace App\Test\Solution\Day20;

use App\Solution\Day20\{Particle, Vector};
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class ParticleTest extends TestCase
{
    public function testBasics()
    {
        $p = m::mock(Vector::class);
        $v = m::mock(Vector::class);
        $a = m::mock(Vector::class);

        $particle = new Particle($p, $v, $a);

        $this->assertSame($p, $particle->position());
        $this->assertSame($v, $particle->velocity());
        $this->assertSame($a, $particle->acceleration());
    }

    public function test_move()
    {
        $p = m::mock(Vector::class);
        $v = m::mock(Vector::class);
        $a = m::mock(Vector::class);

        $nv = m::mock(Vector::class);
        $np = m::mock(Vector::class);

        $v->shouldReceive('sum')
            ->once()
            ->with($a)
            ->andReturn($nv);

        $p->shouldReceive('sum')
            ->once()
            ->with($nv)
            ->andReturn($np);

        $particle = new Particle($p, $v, $a);
        $particle->move();

        $this->assertSame($np, $particle->position());
        $this->assertSame($nv, $particle->velocity());
        $this->assertSame($a, $particle->acceleration());
    }
}
