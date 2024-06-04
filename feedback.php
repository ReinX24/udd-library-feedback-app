<?php

declare(strict_types=1);

require_once "src/boostrap.php";

use classes\Feedback\FeedbackModel;
use classes\Feedback\FeedbackView;
use classes\Feedback\FeedbackController;
use classes\Database\DatabaseConnect;

$name = $_POST["name"];
$feedbackText = $_POST["feedbackText"];

$feedbackController = new FeedbackController($feedbackText);

$errors = $feedbackController->validateInputs();

$feedbackView = new FeedbackView($errors);

session_start();

if ($feedbackView->errorsExist()) {
    $_SESSION["errors"] = $errors;
} else {
    $_SESSION["successMessage"] = "Thank you for your feedback!";

    $database = new DatabaseConnect();
    $pdo = $database->connectDatabase();

    $feedbackModel = new FeedbackModel($pdo);
    $feedbackModel->insertFeedbackData($name, $feedbackText);
}

header("Location: feedback_form.php");
