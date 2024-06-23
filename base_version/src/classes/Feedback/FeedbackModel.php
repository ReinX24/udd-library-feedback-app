<?php

declare(strict_types=1);

namespace classes\Feedback;

class FeedbackModel
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertFeedbackData(string $name, string $feedbackText)
    {
        $insertSql =
            "INSERT INTO
                feedback (name, feedback)
            VALUES
                (:name, :feedback)";

        $statement = $this->pdo->prepare($insertSql);

        $statement->bindValue(":name", $name);
        $statement->bindValue(":feedback", $feedbackText);

        $statement->execute();
    }
}
