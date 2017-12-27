<?php

namespace App\Solution\Day25;

class TuringMachine
{
    /**
     * @var array
     */
    private $tape = [];

    /**
     * @var int
     */
    private $cursor = 0;

    /**
     * @var string
     */
    private $state;

    /**
     * @var array
     */
    private $states = [];

    /**
     * TuringMachine constructor.
     * @param string $initialState
     */
    public function __construct(string $initialState)
    {
        $this->state = $initialState;
    }

    /**
     * Add a new state definition to the machine
     *
     * @param string $state
     * @param int $ifValue1
     * @param int $newValue1
     * @param string $move1
     * @param string $nextState1
     * @param int $ifValue2
     * @param int $newValue2
     * @param string $move2
     * @param string $nextState2
     */
    public function putState(
        string $state,
        int $ifValue1,
        int $newValue1,
        string $move1,
        string $nextState1,
        int $ifValue2,
        int $newValue2,
        string $move2,
        string $nextState2
    ):void {
        $this->states[$state] = function() use ($ifValue1, $ifValue2, $newValue1, $newValue2, $move1, $move2, $nextState1, $nextState2) {
            if ($this->read() === $ifValue1) {
                $this->write($newValue1);
                $this->moveCursor($move1);
                $this->state = $nextState1;
            }
            elseif ($this->read() === $ifValue2) {
                $this->write($newValue2);
                $this->moveCursor($move2);
                $this->state = $nextState2;
            }
        };
    }

    /**
     * Run the machine for a given number of steps
     *
     * @param int $numSteps
     */
    public function run(int $numSteps): void
    {
        for ($i = 0; $i < $numSteps; $i++) {
            $this->states[$this->state]();
        }
    }

    /**
     * Calculate the diagnostic checksum
     *
     * @return int
     */
    public function diagnosticChecksum(): int
    {
        return array_sum($this->tape);
    }

    /**
     * Move the cursor in a given direction
     *
     * @param string $dir
     */
    private function moveCursor(string $dir): void
    {
        if ($dir === 'left') {
            $this->cursor--;
        }
        elseif ($dir === 'right') {
            $this->cursor++;
        }
    }

    /**
     * Read the value from the tape at the cursor's location
     *
     * @return int
     */
    private function read(): int
    {
        if (!array_key_exists($this->cursor, $this->tape)) {
            $this->tape[$this->cursor] = 0;
        }
        return $this->tape[$this->cursor];
    }

    /**
     * Write $value to the tape at the cursor's location
     *
     * @param int $value
     */
    private function write(int $value): void
    {
        $this->tape[$this->cursor] = $value;
    }
}