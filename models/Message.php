<?php

namespace App\Models;

class Message
{
    private int $id;
    private string $content;
    private string $createdAt;
    private bool $isPinned;
    private int $roomId;

    public function __construct(array $data)
    {
        $this->id = (int) ($data['id'] ?? 0);
        $this->content = $data['content'] ?? '';
        $this->createdAt = $data['createdAt'] ?? '';
        $this->isPinned = (bool) ($data['isPinned'] ?? false);
        $this->roomId = (int) ($data['room_id'] ?? 0);
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getContent(): string
    {
        return $this->content;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getIsPinned(): bool
    {
        return $this->isPinned;
    }
    public function getRoomId(): int
    {
        return $this->roomId;
    }
}
