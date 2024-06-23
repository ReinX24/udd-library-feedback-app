<?php

declare(strict_types=1);

require_once "bootstrap.php";

use classes\Feedback\FeedbackModel;
use classes\Feedback\FeedbackView;
use classes\Feedback\FeedbackController;
use classes\Database\DatabaseConnect;

if (isset($_POST["feedback_submit"])) {
    $name = $_POST["name"];
    $feedbackText = $_POST["feedbackText"];

    $database = new DatabaseConnect();
    $pdo = $database->connectDatabase();

    $feedbackController = new FeedbackController($name, $feedbackText);

    $name = $feedbackController->checkAnonymous();

    $errors = $feedbackController->validateInputs();

    $feedbackView = new FeedbackView($errors);

    session_start();

    if ($feedbackView->errorsExist()) {
        $_SESSION["errors"] = $errors;
    } else {
        $_SESSION["successMessage"] = "Thank you for your feedback!";

        $feedbackModel = new FeedbackModel($pdo);
        $feedbackModel->insertFeedbackData($name, $feedbackText);
    }

    header("Location: ../feedback_form.php");
} elseif ($_GET["page"] == "feedback_form") {
    header("Location: ../feedback_form.php");
} elseif ($_GET["page"] == "admin_login") {
    header("Location: ../admin_login_form.php");
} else {
    header("Location: ../index.php");
}
