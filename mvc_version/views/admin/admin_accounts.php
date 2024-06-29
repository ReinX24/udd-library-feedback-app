<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Admin Accounts</h1>
    <?php if ($_SESSION["userLoginInfo"]["master_account"]) : ?>
        <a href="/admin/accounts/add" class="btn btn-primary btn-lg">
            Add Account
        </a>
    <?php endif; ?>
    <table class="table table-bordered mt-4">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <?php if ($_SESSION["userLoginInfo"]["master_account"]) : ?>
                <th scope="col">Master Account</th>
                <th scope="col">Operations</th>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach ($adminData as $admin) : ?>
                <tr>
                    <?php if ($_SESSION["userLoginInfo"]["master_account"]) : ?>
                        <td><?= $admin["id"]; ?></td>
                        <td><?= $admin["username"]; ?></td>
                        <td><?= $admin["master_account"] ? "true" : "false"; ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="/admin/accounts/delete?id=<?= $admin["id"]; ?>" class="btn btn-danger">Delete</a>
                                <a href="/admin/accounts/edit?id=<?= $admin["id"]; ?>" class="btn btn-secondary">Edit</a>
                            </div>
                        </td>
                    <?php else : ?>
                        <?php if (!$admin["master_account"]) : ?>
                            <td><?= $admin["id"]; ?></td>
                            <td><?= $admin["username"]; ?></td>
                        <?php endif; ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/admin_footer.php"; ?>