<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Are you sure you want to delete this account?</h1>
    <?php if ($_SESSION["userLoginInfo"]["id"] == $adminData["id"]) : ?>
        <h4 class="text-danger">This will delete the current account!</h4>
    <?php endif; ?>
    <hr>
    <table class="table table-bordered mt-4">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Master Account</th>
        </thead>
        <tbody>
            <tr>
                <td><?= $adminData["id"]; ?></td>
                <td><?= $adminData["username"]; ?></td>
                <td><?= $adminData["master_account"] ? "true" : "false"; ?></td>
            </tr>
        </tbody>
    </table>
    <form action="/admin/accounts/delete" method="POST" class="d-flex gap-2">
        <input type="hidden" name="id" value="<?= $adminData["id"]; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="/admin/accounts" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>