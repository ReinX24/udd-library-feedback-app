<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Add Admin Account</h1>
    <p class="text-success"><?= ""; ?></p>
    <form action="/admin/accounts/add" method="POST">
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

        <div class="mb-3">
            <label for="repeatPassword" class="form-label">Re-enter Password</label>
            <input type="password" name="passwordRepeat" class="form-control">
        </div>

        <?php if (isset($errors["emptyPasswordRepeatError"])) : ?>
            <div class="alert alert-danger">
                <?= $errors["emptyPasswordRepeatError"]; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($errors["passwordsMismatchError"])) : ?>
            <div class="alert alert-danger">
                <?= $errors["passwordsMismatchError"] ?? ""; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <input type="checkbox" class="btn-check" id="masterAccount" name="masterAccount" <?= $adminData["master_account"] ? "checked" : ""; ?>>
            <label class="btn btn-outline-primary btn-lg" for="masterAccount">Master Account</label>
        </div>

        <hr>

        <button class="btn btn-success btn-lg">Add Account</button>
        <a href="/admin/accounts" class="btn btn-outline-secondary btn-lg">Cancel</a>
    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>