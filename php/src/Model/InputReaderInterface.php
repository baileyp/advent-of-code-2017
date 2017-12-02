<?php

namespace App\Model;

use \Traversable;

interface InputReaderInterface
{
    /**
     * Read all of the input at once into something traversable
     *
     * @return Traversable
     */
    public function readAll() : Traversable;

    /**
     * Read a single line of input and advance the file pointer/cursor to the next line
     *
     * If no next line exists, return NULL
     *
     * @return null|string
     */
    public function readLine() : ?string;
}