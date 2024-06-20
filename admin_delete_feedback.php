<?php
session_start();

if ($_SESSION["isLoggedIn"]) {
    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <h1>Are you sure you want to delete this entry?</h1>
    <hr>
    <h4><?= $_GET["name"]; ?></h4>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $_GET["feedback"]; ?></textarea>
    </div>

    <!-- TODO: finish delete functionality -->
    <form action="" method="POST" class="mt-3">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>