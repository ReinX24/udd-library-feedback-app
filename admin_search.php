<?php

session_start();

if ($_SESSION["isLoggedIn"]) {
    // Get all feedback texts from latest to oldest
    $currentPage = "adminSearch";
    $matchedFeedback = $_SESSION["matchedFeedback"] ?? [];
} else {
    header("Location: index.php");
}

?>

<?php require_once "src/includes/header_admin.inc.php"; ?>

<div class="container mt-4">
    <form action="src/admin_panel.php" method="GET">
        <div class="d-flex gap-2 justify-content-center">
            <input type="hidden" name="page" value="search">
            <input type="text" name="search_text" class="form-control w-50" placeholder="Search feedback text" value="<?= $_GET["search_text"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary">Search text</button>
        </div>
    </form>

    <table class="table mt-4">
        <thead>
            <th scope="col">Name</th>
            <th scope="col">Feedback</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            <?php foreach ($matchedFeedback as $feedback) : ?>
                <tr>
                    <td><?= $feedback["name"]; ?></td>
                    <td><?= substr($feedback["feedback"], 0, 20) . "..."; ?></td>
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
    </table>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>