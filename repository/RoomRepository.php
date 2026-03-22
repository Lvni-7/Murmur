<?php

namespace App\Repository;

use App\Models\Room;
use App\Services\Database;
use PDO;

class RoomRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM rooms ORDER BY name ASC";
        $stmt = $this->db->query($query);
        $rooms = [];
        while ($data = $stmt->fetch()) {
            $rooms[] = new Room($data);
        }
        return $rooms;
    }

    public function findById(int $id): ?Room
    {
        $query = "SELECT * FROM rooms WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ? new Room($data) : null;
    }

    public function save(string $name): void
    {
        $query = "INSERT INTO rooms (name) VALUES (:name)";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['name' => $name]);
    }
}
