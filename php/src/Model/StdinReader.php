<?php

namespace App\Model;

use Traversable;

use ArrayIterator;

class StdinReader implements InputReaderInterface
{
    /**
     * @var array
     */
    protected $input;

    public function __construct(string $input)
    {
        $this->input = explode(PHP_EOL, $input);
    }

    public function readAll(): Traversable
    {
        return new ArrayIterator($this->input);
    }

    public function readLine(): ?string
    {
        $line = current($this->input);
        if ($line) {
            next($this->input);
            return $line;
        }

        return null;
    }
}