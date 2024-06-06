<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    // Get all feedback texts from latest to oldest
    $currentPage = "admin_index";
    $allFeedback = $_SESSION["allFeedback"];
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <h1>Admin Panel</h1>

    <table class="table">
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
                    <td><?= substr($feedback["feedback"], 0, 20) . "..."; ?></td>
                    <td><?= $feedback["created_at"]; ?></td>
                    <td>
                        <form action="src/admin_panel.php" method="POST">
                            <input type="hidden" name="getDetails" value="true">
                            <input type="hidden" name="id" value="<?= $feedback["id"]; ?>">
                            <button type="submit" class="btn btn-primary">Details</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>