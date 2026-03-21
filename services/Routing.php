<?php

namespace Murmur\Services;

use Murmur\Controllers\RoomController;

class Routing
{
    public function handleRequest()
    {
        $action = $_GET['action'] ?? 'home';
        $id = $_GET['id'] ?? null;
        $roomCtrl = new RoomController();

        switch ($action) {
            case 'room':
                $roomCtrl->show($id);
                break;
            default:
                $roomCtrl->index();
                break;
        }
    }
}
