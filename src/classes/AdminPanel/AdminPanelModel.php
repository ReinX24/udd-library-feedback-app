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

    public function getTextMatchFeedback(string $matchString)
    {
        $textMatch =
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

        $statement = $this->pdo->prepare($textMatch);

        $statement->bindValue(":feedback_text", "%$matchString%");

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAllAdminUsernames()
    {
        $getUsernames =
            "SELECT
                id, username
            FROM
                admin_accounts";

        $statement = $this->pdo->prepare($getUsernames);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function insertAdminAccount(string $username, string $password)
    {
        $insertAdmin =
            "INSERT INTO
                admin_accounts (username, password)
            VALUES
                (:username, :password)";

        $statement = $this->pdo->prepare($insertAdmin);

        $statement->bindValue(":username", $username);
        $statement->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));

        $statement->execute();
    }

    public function deleteFeedbackRecord()
    {
        // TODO: finish this delete function
    }
}
