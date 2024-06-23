<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    $currentPage = "adminFeedbackInfo";

    $id = $_GET["id"];
    $name = $_GET["name"];
    $feedback = $_GET["feedback"];
    $createdAtDate = $_GET["createdAt"];
    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <h1><?= $name; ?></h1>
    <p><strong>Created At: </strong><?= $createdAtDate ?></p>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $feedback; ?></textarea>
    </div>
    <div class="d-flex gap-2 mt-4">
        <form action="delete" method="POST">
            <a href="admin_delete_feedback.php?id=<?= $id; ?>&name=<?= $name; ?>&feedback=<?= $feedback; ?>&createdAt=<?= $createdAtDate ?>" class="btn btn-danger">Delete</a>
        </form>
    </div>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>