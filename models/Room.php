<?php

namespace Murmur\Models;

class Room
{
    private $id;
    private $name;

    // getters
    public function getId(): int
    {
        return (int)$this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
