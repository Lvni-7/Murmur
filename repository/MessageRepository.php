<?php

namespace App\Repository;

use App\Models\Message;
use App\Services\Database;
use PDO;

// gere messages
class MessageRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findByRoom(int $roomId): array
    {
        $query = "SELECT * FROM messages WHERE room_id = :room_id ORDER BY createdAt ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['room_id' => $roomId]);
        $messages = [];
        while ($data = $stmt->fetch()) {
            $messages[] = new Message($data);
        }
        return $messages;
    }

    public function getPinnedByRoom(int $roomId): ?Message
    {
        $query = "SELECT * FROM messages WHERE room_id = :room_id AND isPinned = 1 LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['room_id' => $roomId]);
        $data = $stmt->fetch();
        return $data ? new Message($data) : null;
    }

    public function save(string $content, int $roomId): void
    {
        $query = "INSERT INTO messages (content, room_id) VALUES (:content, :roomId)";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['content' => $content, 'roomId' => $roomId]);
    }

    public function pin(int $messageId, int $roomId): void
    {
        $query = "UPDATE messages SET isPinned = 0 WHERE room_id = :roomId";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['roomId' => $roomId]);

        $query = "UPDATE messages SET isPinned = 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $messageId]);
    }

    public function unpin(int $messageId): void
    {
        $query = "UPDATE messages SET isPinned = 0 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $messageId]);
    }
}
