<?php

namespace App\Services;

use App\Controllers\RoomController;
use App\Controllers\MessageController;
use App\Controllers\AboutController;

class Routing
{
    public function handleRequest(): void
    {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'home':
                $controller = new RoomController();
                $controller->index();
                break;
            case 'room':
                $controller = new RoomController();
                $controller->show();
                break;
            case 'create-room':
                $controller = new RoomController();
                $controller->create();
                break;
            case 'send-message':
                $controller = new MessageController();
                $controller->send();
                break;
            case 'pin-message':
                $controller = new MessageController();
                $controller->pin();
                break;
            case 'unpin-message':
                $controller = new MessageController();
                $controller->unpin();
                break;
            case 'about':
                $controller = new AboutController();
                $controller->index();
                break;
            default:
                header("Location: index.php?action=home");
                exit();
        }
    }
}
