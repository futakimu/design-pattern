<?php

namespace DP\core\composite;

class Directory extends Entry
{
    private array $directory = [];
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function size(): int
    {
        $size = 0;
        foreach($this->directory as $entry){
            $size += $entry->size();
        }

        return $size;
    }

    /**
     * @param Entry $entry
     * @return $this
     */
    public function add(Entry $entry): self
    {
        array_push($this->directory , $entry);
        return $this;
    }

    public function printList(string $prefix = ""): void
    {
        echo $prefix . "/" . $this;
        foreach ($this->directory as $entry){
            echo $prefix . "/" . $entry;
        }
    }
}
