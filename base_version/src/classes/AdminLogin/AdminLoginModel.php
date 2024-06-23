<?php

declare(strict_types=1);

namespace classes\AdminLogin;

class AdminLoginModel
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAdminPassword(string $name)
    {
        $getSql =
            "SELECT
                password
            FROM
                admin_accounts
            WHERE
                username = :name";


        $statement = $this->pdo->prepare($getSql);

        $statement->bindValue(":name", $name);

        $statement->execute();

        return $statement->fetch();
    }

    public function getAdminCredentials(string $name, string $password)
    {
        $getSql =
            "SELECT
                *
            FROM
                admin_accounts
            WHERE
                username = :name
            AND
                password = :password";


        $statement = $this->pdo->prepare($getSql);

        $statement->bindValue(":name", $name);
        $statement->bindValue(":password", $password);

        $statement->execute();

        return $statement->fetch();
    }
}
