<?php

namespace Murmur\Controllers;

use Murmur\Repository\RoomRepository;

class RoomController
{
    public function index()
    {
        $roomRepo = new RoomRepository();
        $rooms = $roomRepo->findAll();
        $activeRoom = null; // aucun salon select sur l'accueil

        $view = 'views/room/list.phtml';
        include 'views/layout.phtml';
    }

    public function show($id)
    {
        $roomRepo = new RoomRepository();
        $rooms = $roomRepo->findAll();
        $activeRoom = $roomRepo->find((int)$id);

        $view = 'views/room/show.phtml';
        include 'views/layout.phtml';
    }
}
