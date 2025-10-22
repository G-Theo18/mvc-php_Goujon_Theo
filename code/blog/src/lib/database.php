<?php

namespace Application\Lib;

use PDO;

class DatabaseConnection
{
    private ?PDO $database = null;

    public function getConnection(): PDO
    {
        if ($this->database === null) {
            $this->database = new PDO(
                'mysql:host=localhost;dbname=blog;charset=utf8',
                'blog',
                'password'
            );
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->database;
    }
}
