<?php

namespace App\Controllers;

use App\Repository\RoomRepository;
use App\Repository\MessageRepository;

class RoomController
{
    private RoomRepository $roomRepo;
    private MessageRepository $messageRepo;

    public function __construct()
    {
        $this->roomRepo = new RoomRepository();
        $this->messageRepo = new MessageRepository();
    }

    // On prépare tout pour la page d'accueil
    public function index(): void
    {
        $rooms = $this->roomRepo->findAll();
        $activeRoom = $rooms[0] ?? null;

        $messages = [];
        $pinnedMessage = null;
        if ($activeRoom) {
            $messages = $this->messageRepo->findByRoom($activeRoom->getId());
            $pinnedMessage = $this->messageRepo->getPinnedByRoom($activeRoom->getId());
        }

        $template = 'views/chat/index.phtml';
        require_once 'views/layout.phtml';
    }

    public function show(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $rooms = $this->roomRepo->findAll();
        $activeRoom = $this->roomRepo->findById($id);

        if (!$activeRoom) {
            header("Location: index.php");
            exit();
        }

        $messages = $this->messageRepo->findByRoom($activeRoom->getId());
        $pinnedMessage = $this->messageRepo->getPinnedByRoom($activeRoom->getId());

        $template = 'views/chat/index.phtml';
        require_once 'views/layout.phtml';
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            if (!empty($name)) {
                $this->roomRepo->save($name);
            }
        }
        header("Location: index.php");
        exit();
    }
}
