<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    // Get all feedback texts from latest to oldest
    $currentPage = "admin_index";
    // $singleFeedback = $_SESSION["singleFeedback"];
    // unset($_SESSION["singleFeedback"]);
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<?php

echo "<pre>";
var_dump($_GET);
echo "</pre>";

?>

<?php require_once "src/includes/footer.inc.php"; ?>