<?php

namespace Murmur\Repository;

use Murmur\Services\Database;
use Murmur\Models\Room;

class RoomRepository extends Database
{
    // recup tous les salons pour le menu
    public function findAll(): array
    {
        $query = $this->getDb()->query("SELECT * FROM rooms ORDER BY name ASC");
        return $query->fetchAll(\PDO::FETCH_CLASS, Room::class);
    }

    // recup un salon par son id
    public function find(int $id)
    {
        $query = $this->getDb()->prepare("SELECT * FROM rooms WHERE id = ?");
        $query->execute([$id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Room::class);
        return $query->fetch();
    }
}
