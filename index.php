<?php

spl_autoload_register(function ($className) {
    // retire le prefixe murmur
    $className = str_replace('Murmur\\', '', $className);

    // remplace \ par /
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    // if le fichier existe on le require
    if (file_exists($path)) {
        require_once $path;
    }
});

// instancie le router et lance gestion de la requete
use Murmur\Services\Routing;

$router = new Routing();
$router->handleRequest();
