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

    // TODO: get a single record from our database

} elseif ($_SESSION["isLoggedIn"]) {

    $allFeedback = $adminPanelModel->getAllFeedback();

    $_SESSION["allFeedback"] = $allFeedback;
    header("Location: ../admin_panel_index.php");
} else {
    header("Location: index.php");
}
