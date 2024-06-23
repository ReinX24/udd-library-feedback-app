<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    $currentPage = "adminAdd";
    $adminUsernames = $_SESSION["adminUsernames"];
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <h1>Admin Accounts</h1>
    <a href="add_admin_account.php" class="btn btn-primary btn-lg">
        Add Account
    </a>
    <table class="table table-bordered mt-4">
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
        </thead>
        <tbody>
            <?php foreach ($adminUsernames as $name) : ?>
                <tr>
                    <td><?= $name["id"]; ?></td>
                    <td><?= $name["username"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>