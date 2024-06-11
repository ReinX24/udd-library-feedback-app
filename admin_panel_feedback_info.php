<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    $currentPage = "admin_feedback_info";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <h1><?= $_GET["name"]; ?></h1>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $_GET["feedback"]; ?></textarea>
    </div>
    <div class="d-flex gap-2 mt-4">
        <form action="delete" method="POST">
            <a href="" class="btn btn-danger">Delete</a>
        </form>
        <a href="src/admin_panel.php" class="btn btn-secondary">Return</a>
    </div>
</div>


<?php require_once "src/includes/footer.inc.php"; ?>