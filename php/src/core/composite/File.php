<?php

namespace DP\core\composite;

class File extends Entry
{
    private string $name;
    private int $size;

    public function __construct(string $name, string $size)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function size(): int
    {
        return $this->size;
    }

    protected function printList(string $prefix = ""): void
    {
        echo $prefix . "/" . $this;
    }
}