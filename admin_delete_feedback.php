<?php
session_start();

if ($_SESSION["isLoggedIn"] && $_SERVER["REQUEST_METHOD"] == "GET") {
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
    <h1>Are you sure you want to delete this entry?</h1>
    <hr>
    <h4><?= $name; ?></h4>
    <p><strong>Created At: </strong><?= $createdAtDate ?></p>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $feedback; ?></textarea>
    </div>

    <form action="src/admin_panel.php" method="POST" class="mt-3">
        <input type="hidden" name="deletePost">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>