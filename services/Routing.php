<?php

namespace Murmur\Services;

class Routing
{
    public function handleRequest()
    {
        // recup action dans url
        $action = $_GET['action'] ?? 'home';

        // test
        echo "<h1>Bienvenue sur Murmur</h1>";
        echo "<p>L'infrastructure MVC est prête. Action actuelle : <strong>$action</strong></p>";
    }
}
