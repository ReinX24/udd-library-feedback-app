<?php

if ($_SESSION["isLoggedIn"]) {
    // Get all feedback texts from latest to oldest
    $currentPage = "admin_logout";
} else {
    header("Location: index.php");
}

// session_start();

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <form action="src/admin_panel.php" method="POST">
        <h2>Are you sure you want to logout?</h2>
        <div class="d-flex gap-2 mt-4">
            <form action="src/admin_panel.php" method="POST">
                <input type="hidden" name="logout" value="true">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            <a href="src/admin_panel.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>