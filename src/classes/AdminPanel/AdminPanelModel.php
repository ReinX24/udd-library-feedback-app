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

    public function getSingleFeedback(int $user_id)
    {
        $getSingleFeedback =
            "SELECT
                *
            FROM
                feedback
            WHERE
                id = :userId";

        $statement = $this->pdo->prepare($getSingleFeedback);

        $statement->bindValue(":userId", $user_id);

        $statement->execute();

        return $statement->fetch();
    }

    public function getTextMatchFeedback(string $match_string)
    {
        $text_match_sql =
            "SELECT
                *
            FROM
                feedback
            WHERE
                feedback
            LIKE
                :feedback_text
            ORDER BY
                created_at
            DESC";

        $statement = $this->pdo->prepare($text_match_sql);

        $statement->bindValue(":feedback_text", "%$match_string%");

        $statement->execute();

        return $statement->fetchAll();
    }
}
