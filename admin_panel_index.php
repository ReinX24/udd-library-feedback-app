<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    $currentPage = "adminIndex";
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <img src="src/images/udd_logo.png" class="mb-4" width="200" height="200">
            <h1 class="text-body-emphasis">UdD Library Suggestions Admin Panel</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Admin Panel for accessing UdD Library Suggestions entries and Admin accounts.
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                <a href="src/admin_panel.php?page=search">
                    <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                        Search Feedback
                    </button>
                </a>
                <a href="src/admin_panel.php?page=admin_accounts">
                    <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                        Add Admin Account
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- <h1>Admin Panel</h1>
    <table class="table mt-4">
        <thead>
            <th scope="col">Name</th>
            <th scope="col">Feedback</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            <?php foreach ($allFeedback as $feedback) : ?>
                <tr>
                    <td><?= $feedback["name"]; ?></td>
                    <td><?= strlen($feedback["feedback"]) > 20 ? substr($feedback["feedback"], 0, 20) . "..." : $feedback["feedback"]; ?></td>
                    <td><?= $feedback["created_at"]; ?></td>
                    <td>
                        <form action="src/admin_panel.php" method="POST">
                            <input type="hidden" name="getDetails" value="true">
                            <input type="hidden" name="feedbackId" value="<?= $feedback["id"]; ?>">
                            <button type="submit" class="btn btn-primary">Details</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> -->
</div>

<?php require_once "src/includes/footer.inc.php"; ?>