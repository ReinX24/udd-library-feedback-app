<?php require_once "includes/admin_header.php"; ?>

<?php
// echo "<pre>";
// var_dump($_SESSION);
// var_dump($adminData);
// var_dump($errors);
// echo "</pre>";
?>

<div class="container mt-4">
    <h1>Edit Admin Account</h1>

    <?php if ($_SESSION["userLoginInfo"]["username"] == $adminData["username"]) : ?>
        <div class="alert alert-warning fs-4">
            You are editing the current logged in account!
        </div>
    <?php endif; ?>

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

            <?php if (isset($errors["usernameTakenError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["usernameTakenError"]; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <?php if (isset($errors["emptyPasswordError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["emptyPasswordError"]; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors["wrongPasswordError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["wrongPasswordError"]; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <input type="checkbox" class="btn-check" id="changePassword" name="changePassword" <?= $adminData["changePassword"] ? "checked" : ""; ?>>
                <label class="btn btn-outline-danger btn-lg" for="changePassword">Change Password</label>
            </div>

            <div class="mb-3">
                <label for="passwordNew" class="form-label">New Password</label>
                <input type="password" name="passwordNew" class="form-control">
            </div>

            <?php if (isset($errors["emptyPasswordNewError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["emptyPasswordNewError"]; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="passwordNewRepeat" class="form-label">Repeat New Password</label>
                <input type="password" name="passwordNewRepeat" class="form-control">
            </div>

            <?php if (isset($errors["emptyPasswordRepeatNewError"])) : ?>
                <div class="alert alert-danger">
                    <?= $errors["emptyPasswordRepeatNewError"]; ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <input type="checkbox" class="btn-check" id="masterAccount" name="master_account" <?= $adminData["master_account"] ? "checked" : ""; ?>>
                <label class="btn btn-outline-primary btn-lg" for="masterAccount">Master Account</label>
            </div>

            <input type="hidden" name="id" value="<?= $adminData["id"]; ?>">

            <hr>

            <button class="btn btn-success btn-lg">Apply Changes</button>
            <a href="/admin/accounts" class="btn btn-secondary btn-lg">Cancel</a>

    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>