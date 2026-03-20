<?php

namespace Murmur\Services;

require_once 'configs/settings.php';

abstract class Database
{
    private static $_db;

    protected function getDb()
    {
        if (self::$_db === null) {
            try {
                self::$_db = new \PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                    DB_USER,
                    DB_PASS,
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                    ]
                );
            } catch (\Exception $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }
        return self::$_db;
    }
}
