<?php

declare(strict_types=1);

namespace classes\AdminLogin;

class AdminLoginModel
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->$pdo = $pdo;
    }

    public function getAdminPassword($name)
    {
        $getSql =
            "SELECT
                *
            FROM
                admin_accounts
            WHERE
                username = :name";


        $statement = $this->pdo->prepare($getSql);

        $statement->bindValue($name);

        $statement->execute();

        return $statement->fetch();
    }
}
