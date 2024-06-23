<?php

declare(strict_types=1);

namespace app;

use \PDO;

class Database
{
    public PDO $pdo;
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=feedback_app",
            "root",
            ""
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        self::$db = $this;
    }

    public function getFeedback()
    {
    }
}
