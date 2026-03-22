<?php

namespace App\Models;

class Room
{
    private int $id;
    private string $name;
    private ?string $description;
    private string $createdAt;

    public function __construct(array $data)
    {
        $this->id = (int) $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'] ?? null;
        $this->createdAt = $data['createdAt'];
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
