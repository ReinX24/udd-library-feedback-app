<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1><?= $feedback["name"]; ?></h1>
    <p><strong>Created At: </strong><?= $feedback["created_at"]; ?></p>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $feedback["feedback"]; ?></textarea>
    </div>

    <?php if ($_SESSION["userLoginInfo"]["master_account"]) : ?>
        <div class="d-flex gap-2 mt-4">
            <form action="/admin/search/delete" method="GET">
                <input type="hidden" name="feedbackId" value="<?= $feedback["id"]; ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    <?php endif; ?>

</div>

<?php require_once "includes/admin_footer.php"; ?>