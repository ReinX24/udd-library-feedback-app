<?php

declare(strict_types=1);

namespace classes\AdminPanel;

class AdminPanelModel
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllFeedback()
    {
        $getAllFeedback =
            "SELECT
                *
            FROM
                feedback
            ORDER BY
                created_at
            DESC";

        $statement = $this->pdo->prepare($getAllFeedback);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getSingleFeedback(int $userId)
    {
        $getSingleFeedback =
            "SELECT
                *
            FROM
                feedback
            WHERE
                id = :userId";

        $statement = $this->pdo->prepare($getSingleFeedback);

        $statement->bindValue(":userId", $userId);

        $statement->execute();

        return $statement->fetch();
    }
}
