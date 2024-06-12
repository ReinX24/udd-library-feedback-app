<?php

declare(strict_types=1);

require_once "bootstrap.php";

use classes\AdminPanel\AdminPanelModel;
// use classes\AdminPanel\AdminPanelView;
// use classes\AdminPanel\AdminPanelController;
use classes\Database\DatabaseConnect;

session_start();

// Index page will show all the feedback entries at the index
$database = new DatabaseConnect();
$pdo = $database->connectDatabase();

// Get all feedback texts from latest to oldest
$adminPanelModel = new AdminPanelModel($pdo);

if ($_SESSION["isLoggedIn"] && isset($_POST["getDetails"])) {

    $feedbackId = (int) $_POST["feedbackId"];
    $singleFeedback = $adminPanelModel->getSingleFeedback($feedbackId);

    $name = $singleFeedback["name"];
    $feedbackText = $singleFeedback["feedback"];
    $createdAtDate = $singleFeedback["created_at"];

    header("Location: ../admin_panel_feedback_info.php?name=$name&feedback=$feedbackText&createdAt=$createdAtDate");
} elseif ($_SESSION["isLoggedIn"] && isset($_POST["logout"])) {
    unset($_SESSION);
    session_destroy();
    header("Location: ../index.php");
} elseif ($_SESSION["isLoggedIn"] && $_GET["page"] == "admin_add") {
    // TODO: get current admin account usernames
    $adminUsernames = $adminPanelModel->getAllAdminUsernames();
    $_SESSION["adminUsernames"] = $adminUsernames;
    header("Location: ../add_admin.php");
} elseif ($_SESSION["isLoggedIn"] && $_GET["page"] == "search") {
    $_SESSION["matchedFeedback"] = $adminPanelModel->getTextMatchFeedback($_GET["search_text"] ?? "");

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    header("Location: ../admin_search.php?search_text=" . $_GET["search_text"]);
} elseif ($_SESSION["isLoggedIn"] && $_GET["page"] == "index") {

    // $allFeedback = $adminPanelModel->getAllFeedback();

    // $_SESSION["allFeedback"] = $allFeedback;
    header("Location: ../admin_panel_index.php");
} else {
    header("Location: ../index.php");
}
