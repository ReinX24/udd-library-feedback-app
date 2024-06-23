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

    public function getMonthAndYearMatchFeedback(string $monthYearString)
    {
        $dateMatch =
            "SELECT
                *
            FROM
                feedback
            WHERE
                YEAR(created_at) = :yearMatch
            AND
                MONTH(created_at) = :monthMatch
            ORDER BY
                created_at
            DESC";

        $monthMatch = date("m", strtotime($monthYearString));
        $yearMatch = date("Y", strtotime($monthYearString));

        $statement = $this->pdo->prepare($dateMatch);

        $statement->bindValue(":yearMatch", $yearMatch);
        $statement->bindValue(":monthMatch", $monthMatch);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getDateFeedack(string $dateString)
    {
        $getDate =
            "SELECT
                *
            FROM
                feedback
            WHERE
                YEAR(created_at) = :yearMatch
            AND
                MONTH(created_at) = :monthMatch
            AND
                DAY(created_at) = :dayMatch";

        $yearMatch = date("Y", strtotime($dateString));
        $monthMatch = date("m", strtotime($dateString));
        $dayMatch = date("d", strtotime($dateString));

        $statement = $this->pdo->prepare($getDate);

        $statement->bindValue(":yearMatch", $yearMatch);
        $statement->bindValue(":monthMatch", $monthMatch);
        $statement->bindValue(":dayMatch", $dayMatch);

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
        $id = $_POST["id"];

        $deleteFeedback =
            "DELETE FROM
                feedback
            WHERE
                id = :id";

        $statement = $this->pdo->prepare($deleteFeedback);

        $statement->bindValue(":id", $id);

        $statement->execute();
    }
}
