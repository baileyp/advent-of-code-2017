<?php

namespace App\Solution\Day18;

use \Countable;
use \SplQueue;

class DuetProgram extends Duet implements Countable
{
    /**
     * @var SplQueue
     */
    private $queue;

    /**
     * @var DuetProgram
     */
    private $partner;

    /**
     * @var int
     */
    private $sendCount = 0;

    /**
     * DuetProgram constructor.
     * @param array $instructions
     * @param string $programId
     */
    public function __construct(array $instructions, string $programId)
    {
        parent::__construct($instructions);
        $this->queue = new SplQueue();
        $this->registers['p'] = $programId;
    }

    /**
     * Assign the partner program
     *
     * @param DuetProgram $partner
     */
    public function duetWith(DuetProgram $partner): void
    {
        $this->partner = $partner;
    }

    /**
     * Accept a value sent from a partner and store it in the queue
     *
     * @param string $x
     */
    public function accept(string $x)
    {
        $this->queue->enqueue($x);
    }

    /**
     * Send the value in register $x to the partner program
     *
     * @param string $x
     */
    public function snd(string $x): void
    {
        $this->partner->accept($this->normalize($x));
        $this->sendCount++;
        $this->cursor++;
    }

    /**
     * Receive the next value from the queue and store it in register $x. If no values exist in the queue, halt
     *
     * @param string $x
     * @throws HaltException
     */
    public function rcv(string $x): void
    {
        if ($this->isWaiting()) {
            if ($this->partner->isWaiting()) {
                throw new HaltException('Deadlock');
            }
            $this->partner->play();
            throw new HaltException('Waiting');
        }

        $this->registers[$x] = $this->queue->dequeue();
        $this->cursor++;
    }

    /**
     * Is this program waiting to receive a value?
     *
     * @return bool
     */
    public function isWaiting(): bool
    {
        return $this->queue->count() === 0;
    }

    /**
     * Return the number of times this program send a value to its partner
     *
     * @return int
     */
    public function count(): int
    {
        return $this->sendCount;
    }
}