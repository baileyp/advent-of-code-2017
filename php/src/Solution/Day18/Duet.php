<?php

namespace App\Solution\Day18;

class Duet
{
    /**
     * @var array
     */
    private $instructions = [];

    /**
     * @var int
     */
    private $sound = 0;

    /**
     * @var int
     */
    protected $cursor = 0;

    /**
     * @var array
     */
    protected $registers;

    /**
     * Duet constructor.
     * @param array $instructions
     */
    public function __construct(array $instructions)
    {
        $this->registers = array_combine(range('a', 'z'), array_fill(0, 26, 0));

        // Convert raw instructions into simple callables
        $this->instructions = array_map(function (string $instruction) {
            $parts = explode(' ', $instruction);
            return function() use ($parts) {
                $func = array_shift($parts);
                call_user_func([$this, $func], ...$parts);
            };
        }, $instructions);
    }

    /**
     * Recover the last sound played
     *
     * @return int
     */
    public function recover(): int
    {
        return $this->sound;
    }

    /**
     * Play the duet i.e., run all the instructions until a HaltException is encountered or the cursor runs out of bounds
     */
    public function play(): void
    {
        try {
            while (array_key_exists($this->cursor, $this->instructions)) {
                call_user_func($this->instructions[$this->cursor]);
            }
        }
        catch (HaltException $e) {
            // nothing
        }
    }

    /**
     * "Play" the sound at register $x
     *
     * @param string $x
     */
    public function snd(string $x): void
    {
        $this->sound = $this->normalize($x);
        $this->cursor++;
    }

    /**
     * Assign the value of register $y to register $x
     *
     * @param string $x
     * @param string $y
     */
    public function set(string $x, string $y): void
    {
        $this->registers[$x] = $this->normalize($y);
        $this->cursor++;
    }

    /**
     * Assign the result of $x plus $y to the register $x
     *
     * @param string $x
     * @param string $y
     */
    public function add(string $x, string $y): void
    {
        $this->registers[$x] += $this->normalize($y);
        $this->cursor++;
    }

    /**
     * Assign the result of $x times $y to the register $x
     *
     * @param string $x
     * @param string $y
     */
    public function mul(string $x, string $y): void
    {
        $this->registers[$x] *= $this->normalize($y);
        $this->cursor++;
    }

    /**
     * Assign the result of $x modulo $y to the register $x
     *
     * @param string $x
     * @param string $y
     */
    public function mod(string $x, string $y): void
    {
        $this->registers[$x] %= $this->normalize($y);
        $this->cursor++;
    }

    /**
     * If the value at register $x is zero, continue. Otherwise, halt, allowing recovery of the last sound
     *
     * @param string $x
     * @throws HaltException
     */
    public function rcv(string $x): void
    {
        $value = $this->normalize($x);
        if ($value !== 0) {
            throw new HaltException();
        }
        $this->cursor++;
    }

    /**
     * Jump by $y instructions if register $x is greater than zero
     *
     * @param string $x
     * @param string $y
     */
    public function jgz(string $x, string $y): void
    {
        if ($this->normalize($x) > 0) {
            $this->cursor += $this->normalize($y);
        } else {
            $this->cursor++;
        }
    }

    /**
     * Normalize an input value by either casting a numeric as an int, or reading a register's value
     *
     * @param string $value
     * @return int
     */
    protected function normalize(string $value): int
    {
        if (is_numeric($value)) {
            return (int) $value;
        }
        return $this->registers[$value];
    }
}