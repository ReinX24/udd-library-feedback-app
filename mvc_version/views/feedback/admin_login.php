<?php require_once "includes/feedback_header.php"; ?>

<div class="container mt-4">
    <h1>Admin Login</h1>
    <form action="/feedback/admin_login" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label fs-5">Username</label>
            <input type="text" name="name" class="form-control form-control-lg" value="<?= $adminLoginData["username"] ?? "" ?>">
        </div>
        <?php if (isset($errors["usernameEmptyError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["usernameEmptyError"]; ?>
            </div>
        <?php elseif (isset($errors["userNotFoundError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["userNotFoundError"]; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="password" class="form-label fs-5">Password</label>
            <input type="password" name="password" class="form-control form-control-lg">
        </div>

        <?php if (isset($errors["passwordEmptyError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["passwordEmptyError"]; ?>
            </div>
        <?php elseif (isset($errors["wrongPasswordError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["wrongPasswordError"]; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="password" class="form-label fs-5">Re-enter Password</label>
            <input type="password" name="passwordRepeat" class="form-control form-control-lg">
        </div>

        <?php if (isset($errors["passwordsMismatchError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["passwordsMismatchError"]; ?>
            </div>
        <?php elseif (isset($errors["passwordRepeatError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["passwordRepeatError"]; ?>
            </div>
        <?php endif; ?>

        <button type="submit" name="login" value="login" class="btn btn-primary btn-lg">Login</button>
    </form>
</div>

<?php require_once "includes/feedback_footer.php"; ?>