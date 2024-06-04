<?php

session_start();

$currentPage = "adminLoginForm";

$emptyUsername = $_SESSION["emptyUsernameError"] ?? "";
$invalidCredentials = $_SESSION["invalidCredentialsError"] ?? "";

session_destroy();
unset($_SESSION);

?>

<?php require_once "src/includes/header.inc.php"; ?>

<div class="container mt-3">
    <h1>Admin Login</h1>
    <form action="src/admin_login.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <?php if ($emptyUsername) : ?>
            <div class="alert alert-danger">
                <?= $emptyUsername; ?>
            </div>
        <?php elseif ($invalidCredentials) : ?>
            <div class="alert alert-danger">
                <?= $invalidCredentials; ?>
            </div>
        <?php endif; ?>

        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>