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

    $pageRequest = $_GET["page"];

    if (isset($_GET["getDetails"]) && isset($_GET["feedbackId"]) && $pageRequest == "detailsPage") {
        // Go to page showing single feedback information
        $feedbackId = (int) $_GET["feedbackId"];
        $singleFeedback = $adminPanelModel->getSingleFeedback($feedbackId);

        $id = $singleFeedback["id"];
        $name = $singleFeedback["name"];
        $feedbackText = $singleFeedback["feedback"];
        $createdAtDate = $singleFeedback["created_at"];

        header("Location: ../admin_panel_feedback_info.php?id=$id&name=$name&feedback=$feedbackText&createdAt=$createdAtDate");
    } elseif ($pageRequest == "index") {
        // Go to the admin_panel_index
        header("Location: ../admin_panel_index.php");
    } elseif ($pageRequest == "admin_accounts") {
        // Go to admin_accounts page
        $adminUsernames = $adminPanelModel->getAllAdminUsernames();
        $_SESSION["adminUsernames"] = $adminUsernames;
        header("Location: ../admin_accounts.php");
    } elseif ($pageRequest == "search") {
        // Go to search page

        $_SESSION["matchedFeedback"] = $adminPanelModel->getTextMatchFeedback($_GET["search_text"] ?? "");

        if (isset($_GET["search_text"])) {
            $_SESSION["matchedFeedback"] = $adminPanelModel->getTextMatchFeedback($_GET["search_text"] ?? "");
            header("Location: ../admin_search.php?search_text=" . $_GET["search_text"]);
        } elseif (isset($_GET["search_month_and_year"])) {
            var_dump($_GET["search_month_and_year"]);
            // TODO: find feedback by month and year
            exit;
        }

        header("Location: ../admin_search.php");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["isLoggedIn"] && isset($_POST["logout"])) {
        session_unset();
        session_destroy();

        header("Location: ../index.php");
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
    } elseif ($_SESSION["isLoggedIn"] && isset($_POST["deletePost"])) {
        $adminPanelModel->deleteFeedbackRecord();

        // Go back to the search page
        header("Location: admin_panel.php?page=search");
    }
}

exit; // terminate script here

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
    if (isset($_GET["search_text"])) {
        $_SESSION["matchedFeedback"] = $adminPanelModel->getTextMatchFeedback($_GET["search_text"] ?? "");
    } elseif (isset($_GET["search_month"])) {
        echo "Search Month!";
        exit;
    }

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    header("Location: ../admin_search.php?search_text=" . $_GET["search_text"]);
} elseif ($_SESSION["isLoggedIn"] && isset($_GET["page"]) && $_GET["page"] == "index") {
    // $allFeedback = $adminPanelModel->getAllFeedback();

    // $_SESSION["allFeedback"] = $allFeedback;
    header("Location: ../admin_panel_index.php");
} elseif ($_SESSION["isLoggedIn"] && isset($_POST["deletePost"])) {
    $adminPanelModel->deleteFeedbackRecord();

    // Go back to the search page
    header("Location: admin_panel.php?page=search");
} else {
    header("Location: ../index.php");
}
