<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Add Admin Account</h1>
    <p class="text-success"><?= ""; ?></p>
    <form action="/admin/accounts/add" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $adminData["username"] ?? "" ?>">
            <p class="text-danger"><?= $errors["emptyUsernameError"] ?? ""; ?></p>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Passord</label>
            <input type="password" name="password" class="form-control">
            <p class="text-danger"><?= $errors["emptyPasswordError"] ?? ""; ?></p>
        </div>
        <div class="mb-3">
            <label for="repeatPassword" class="form-label">Re-enter Password</label>
            <input type="password" name="passwordRepeat" class="form-control">
            <p class="text-danger"><?= $errors["emptyPasswordRepeatError"] ?? ""; ?></p>
            <p class="text-danger"><?= $errors["passwordsMismatchError"] ?? ""; ?></p>
        </div>

        <button class="btn btn-primary">Add Account</button>
        <a href="/admin/accounts" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>