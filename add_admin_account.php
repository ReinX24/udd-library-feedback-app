<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    $currentPage = "adminAdd";

    $emptyUsernameError = $_SESSION["errors"]["emptyUsernameError"] ?? "";

    unset($_SESSION["errors"]); // remove all errors on next refresh
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <h1>Add Admin Account</h1>
    <form action="src/admin_panel.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control">
            <p><?= $emptyUsernameError; ?></p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Passord</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="repeatPassword" class="form-label">Re-enter Password</label>
            <input type="password" name="repeatPassword" class="form-control">
        </div>

        <input type="hidden" name="add_admin">

        <button class="btn btn-primary">Add Account</button>
        <a href="src/admin_panel.php?page=index" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>