<?php

declare(strict_types=1);

namespace app;

use app\models\Feedback;
use app\models\Admin;
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

    public function createFeedback(Feedback $feedback)
    {
        $createFeedbackQuery =
            "INSERT INTO
                feedback (name, feedback)
            VALUES
                (:name, :feedbackText)";

        $statement = $this->pdo->prepare($createFeedbackQuery);

        $statement->bindValue(":name", $feedback->name);
        $statement->bindValue(":feedbackText", $feedback->feedbackText);

        $statement->execute();
    }

    public function getAdminCredentials(Admin $adminData)
    {
        $getAdminQuery =
            "SELECT
                *
            FROM
                admin_accounts
            WHERE
                username = :username";

        $statement = $this->pdo->prepare($getAdminQuery);

        $statement->bindValue(":username", $adminData->username);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
