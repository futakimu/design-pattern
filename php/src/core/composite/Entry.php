<?php

namespace DP\core\composite;

abstract class Entry
{
    abstract protected function name(): string;
    abstract protected function size(): int;

    public function add(Entry $entry): self
    {
        throw new FileTreatmentException();
    }

    abstract protected function printList(string $prefix = ""): void;

    public function __toString(): string
    {
        return $this->name() . "(" . $this->size() . ")";
    }
}
