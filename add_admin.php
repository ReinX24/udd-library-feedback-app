<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    $currentPage = "adminAdd";
} else {
    header("Location: index.php");
}

?>


<?php require_once "src/includes/header_admin.inc.php"; ?>
<!-- TODO: add table showing current admin accounts -->
<?php require_once "src/includes/footer.inc.php"; ?>