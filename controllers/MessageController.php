<?php

namespace App\Controllers;

use App\Repository\MessageRepository;

class MessageController
{
    private MessageRepository $messageRepo;

    public function __construct()
    {
        $this->messageRepo = new MessageRepository();
    }

    public function send(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $roomId = (int) ($_POST['room_id'] ?? 0);
            if (!empty($content) && $roomId > 0) {
                $this->messageRepo->save($content, $roomId);
            }
            header("Location: index.php?action=room&id=" . $roomId);
            exit();
        }
        header("Location: index.php");
    }

    public function pin(): void
    {
        $messageId = (int) ($_GET['id'] ?? 0);
        $roomId = (int) ($_GET['room_id'] ?? 0);
        if ($messageId > 0 && $roomId > 0) {
            $this->messageRepo->pin($messageId, $roomId);
        }
        header("Location: index.php?action=room&id=" . $roomId);
    }

    public function unpin(): void
    {
        $messageId = (int) ($_GET['id'] ?? 0);
        $roomId = (int) ($_GET['room_id'] ?? 0);
        if ($messageId > 0) {
            $this->messageRepo->unpin($messageId);
        }
        header("Location: index.php?action=room&id=" . $roomId);
    }
}
