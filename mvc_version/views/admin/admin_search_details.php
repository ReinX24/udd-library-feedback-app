<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1><?= $feedback["name"]; ?></h1>
    <p><strong>Created At: </strong><?= $feedback["created_at"]; ?></p>
    <p><strong>Category: </strong><?= $feedback["category"]; ?></p>

    <!-- TODO: add functionality to edit entries. Show that these are edited. -->
    <?php if ($_SESSION["userLoginInfo"]["master_account"]): ?>
        <a href="/admin/search/edit?feedbackId=<?= $feedback["id"]; ?>" class="btn btn-primary btn-lg">Edit</a>
    <?php endif; ?>

    <div class="form-floating mt-4">
        <textarea class="form-control" id="feedbackText" style="height: 12rem;" disabled><?= $feedback["feedback"]; ?></textarea>
        <label for="feedbackText">Feedback</label>
    </div>

    <div class="d-flex gap-2 mt-4">
        <?php if ($_SESSION["userLoginInfo"]["master_account"]): ?>
            <form action="/admin/search/delete" method="GET">
                <input type="hidden" name="feedbackId" value="<?= $feedback["id"]; ?>">
                <button type="submit" class="btn btn-danger btn-lg">Delete</button>
            </form>
        <?php endif; ?>

        <a href="/admin/search" class="btn btn-secondary btn-lg">Cancel</a>
    </div>

</div>

<?php require_once "includes/admin_footer.php"; ?>