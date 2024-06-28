<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Admin Accounts</h1>
    <a href="/admin/accounts/add" class="btn btn-primary btn-lg">
        Add Account
    </a>
    <table class="table table-bordered mt-4">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Master Account</th>
        </thead>
        <tbody>
            <?php foreach ($adminData as $admin) : ?>
                <tr>
                    <td><?= $admin["id"]; ?></td>
                    <td><?= $admin["username"]; ?></td>
                    <td><?= $admin["master_account"] ? "true" : "false"; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "includes/admin_footer.php"; ?>