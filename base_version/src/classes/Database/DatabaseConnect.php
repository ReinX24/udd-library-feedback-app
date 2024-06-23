<?php

declare(strict_types=1);

namespace classes\Database;

use PDO;
use PDOException;

class DatabaseConnect
{

    private string $host;
    private string $name;
    private string $password;
    private string $db;

    public function __construct()
    {
        $this->host = "localhost";
        $this->name = "root";
        $this->password = "";
        $this->db = "feedback_app";
    }

    public function connectDatabase()
    {
        try {

            $dataSourceName = "mysql:host=$this->host;dbname=$this->db";

            $pdo = new PDO($dataSourceName, $this->name, $this->password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            echo "Database Connection Error: " . $e->getMessage();
            exit();
        }
    }
}
