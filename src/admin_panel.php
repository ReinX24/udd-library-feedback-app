<?php

declare(strict_types=1);

require_once "bootstrap.php";

use classes\AdminPanel\AdminPanelModel;
use classes\AdminPanel\AdminPanelView;
use classes\AdminPanel\AdminPanelController;
use classes\Database\DatabaseConnect;

session_start();

// Index page will show all the feedback entries at the index
$database = new DatabaseConnect();
$pdo = $database->connectDatabase();

// Get all feedback texts from latest to oldest
$adminPanelModel = new AdminPanelModel($pdo);

if ($_SESSION["isLoggedIn"] && $_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["getDetails"] && $_GET["feedbackId"]) {
        $feedbackId = (int) $_GET["feedbackId"];
        $singleFeedback = $adminPanelModel->getSingleFeedback($feedbackId);

        $name = $singleFeedback["name"];
        $feedbackText = $singleFeedback["feedback"];
        $createdAtDate = $singleFeedback["created_at"];

        header("Location: ../admin_panel_feedback_info.php?name=$name&feedback=$feedbackText&createdAt=$createdAtDate");
    } elseif ($_GET["page"] == "admin_accounts") {
        $adminUsernames = $adminPanelModel->getAllAdminUsernames();
        $_SESSION["adminUsernames"] = $adminUsernames;
        header("Location: ../admin_accounts.php");
    }
}

if ($_SESSION["isLoggedIn"] && isset($_GET) && isset($_GET["getDetails"]) && isset($_GET["feedbackId"])) {
    $feedbackId = (int) $_GET["feedbackId"];
    $singleFeedback = $adminPanelModel->getSingleFeedback($feedbackId);

    $id = $singleFeedback["id"];
    $name = $singleFeedback["name"];
    $feedbackText = $singleFeedback["feedback"];
    $createdAtDate = $singleFeedback["created_at"];

    header("Location: ../admin_panel_feedback_info.php?id=$id&name=$name&feedback=$feedbackText&createdAt=$createdAtDate");
} elseif ($_SESSION["isLoggedIn"] && isset($_POST["logout"])) {
    session_unset();
    session_destroy();

    header("Location: ../index.php");
} elseif ($_SESSION["isLoggedIn"] && isset($_GET["page"]) && $_GET["page"] == "admin_accounts") {
    $adminUsernames = $adminPanelModel->getAllAdminUsernames();
    $_SESSION["adminUsernames"] = $adminUsernames;
    header("Location: ../admin_accounts.php");
} elseif ($_SESSION["isLoggedIn"] && isset($_POST["add_admin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];

    $adminPanelController = new AdminPanelController($username, $password, $repeatPassword);

    $errors = $adminPanelController->validateInputs();

    $adminPanelView = new AdminPanelView($errors);

    if ($adminPanelView->errorsExist()) {
        $_SESSION["errors"] = $errors;
    } else {
        $_SESSION["successMessage"] = "Admin account created!";
        $adminPanelModel->insertAdminAccount($username, $password);
    }

    header("Location: ../add_admin_account.php");
} elseif ($_SESSION["isLoggedIn"] && isset($_GET["page"]) && $_GET["page"] == "search") {
    $_SESSION["matchedFeedback"] = $adminPanelModel->getTextMatchFeedback($_GET["search_text"] ?? "");

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    header("Location: ../admin_search.php?search_text=" . $_GET["search_text"]);
} elseif ($_SESSION["isLoggedIn"] && isset($_GET["page"]) && $_GET["page"] == "index") {
    // $allFeedback = $adminPanelModel->getAllFeedback();

    // $_SESSION["allFeedback"] = $allFeedback;
    header("Location: ../admin_panel_index.php");
} else {
    header("Location: ../index.php");
}
