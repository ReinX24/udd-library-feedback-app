<?php

session_start();

$currentPage = "adminLoginForm";

$emptyUsername = $_SESSION["errors"]["emptyUsernameError"] ?? "";
$emptyPassword = $_SESSION["errors"]["emptyPasswordError"] ?? "";
$wrongPassword = $_SESSION["errors"]["passwordMismatchError"] ?? "";

// var_dump($_SESSION);

session_destroy();
unset($_SESSION);

?>

<?php require_once "src/includes/header.inc.php"; ?>

<div class="container mt-4">
    <h1>Admin Login</h1>
    <form action="src/admin_login.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" class="form-control">
        </div>

        <?php if ($emptyUsername) : ?>
            <div class="alert alert-danger">
                <?= $emptyUsername; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <?php if ($emptyPassword) : ?>
            <div class="alert alert-danger">
                <?= $emptyPassword; ?>
            </div>
        <?php elseif ($wrongPassword) : ?>
            <div class="alert alert-danger">
                <?= $wrongPassword; ?>
            </div>
        <?php endif; ?>

        <button type="submit" name="login" value="login" class="btn btn-primary btn-lg">Login</button>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>