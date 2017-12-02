<?php

namespace App\Model;

use \RuntimeException;
use \SplFileObject;
use \Traversable;

class FileInputReader implements InputReaderInterface
{
    protected $file;
    protected $handle;

    public function __construct(string $path)
    {
        $this->file = new SplFileObject($path, 'r+');
        $this->file->setFlags(SplFileObject::DROP_NEW_LINE);
        $this->file->flock(LOCK_SH);
    }

    public function __destruct()
    {
        $this->file->flock(LOCK_UN);
    }

    public function readAll(): Traversable
    {
        return $this->file;
    }

    public function readLine(): ?string
    {
        $output = null;
        if ($this->file->valid()) {
            $output = trim($this->file->current(), " \n\r\t");
            $this->file->next();
        }
        return $output;
    }
}