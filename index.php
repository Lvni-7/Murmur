<?php

// error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'configs/settings.php';

// charge auto les classes
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $parts = explode('\\', $relative_class);
    if (count($parts) > 1) {
        $parts[0] = strtolower($parts[0]);
    }

    $file = $base_dir . implode('/', $parts) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use App\Services\Routing;

$router = new Routing();
$router->handleRequest();
