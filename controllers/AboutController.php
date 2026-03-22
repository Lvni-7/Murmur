<?php

namespace App\Controllers;

use App\Repository\RoomRepository;

class AboutController
{
    private RoomRepository $roomRepo;

    public function __construct()
    {
        $this->roomRepo = new RoomRepository();
    }

    public function index(): void
    {
        $rooms = $this->roomRepo->findAll();
        $activeRoom = null;

        $template = 'views/about/index.phtml';
        require_once 'views/layout.phtml';
    }
}
