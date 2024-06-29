<?php require_once "includes/admin_header.php"; ?>

<?php
var_dump($adminData);
?>

<div class="container mt-4">
    <h1>Edit Admin Account</h1>
    <form action="/admin/accounts/edit" method="POST">
        <div class="mb-3">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $adminData["username"] ?? "" ?>">
            </div>

            <?php if (isset($errors["emptyUsernameError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["emptyUsernameError"]; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="password" class="form-label">Old Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <?php if (isset($errors["emptyPasswordError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["emptyPasswordError"]; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="passwordNew" class="form-label">New Password</label>
                <input type="password" name="passwordNew" class="form-control">
            </div>

            <div class="mb-3">
                <label for="passwordNewRepeat" class="form-label">Repeat New Password</label>
                <input type="password" name="passwordNewRepeat" class="form-control">
            </div>

            <!-- TODO: drop down list of master account or not -->
            <div>
            </div>

            <input type="hidden" name="id" value="<?= $adminData["id"]; ?>">

            <button class="btn btn-primary">Apply Changes</button>
            <a href="/admin/accounts" class="btn btn-secondary">Cancel</a>

    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>