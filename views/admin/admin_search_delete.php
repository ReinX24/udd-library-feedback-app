<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Are you sure you want to delete this entry?</h1>

    <hr>

    <h1><?= $feedback["name"]; ?></h1>
    <p class="fs-5"><strong>Created At: </strong><?= date("m/d/Y h:i:s A", strtotime($feedback["created_at"])); ?></p>
    <p class="fs-5"><strong>Category: </strong><?= $feedback["category"]; ?></p>
    <p class="fs-5"><strong>Edited: </strong><?= $feedback["is_edited"] ? "true" : "false"; ?></p>

    <div class="mt-4">
        <label for="feedbackText" class="form-label fs-5">Feedback</label>
        <textarea class="form-control form-control-lg" id="feedbackText" style="height: 12rem;" disabled><?= $feedback["feedback"]; ?></textarea>
    </div>

    <div class="d-flex gap-2 mt-4">
        <?php if ($_SESSION["userLoginInfo"]["master_account"]): ?>
            <form action="/admin/search/delete" method="POST">
                <input type="hidden" name="feedbackId" value="<?= $feedback["id"]; ?>">
                <button type="submit" class="btn btn-danger btn-lg">Delete</button>
            </form>
        <?php endif; ?>
        <a href="/admin/search/details?feedbackId=<?= $feedback["id"]; ?>" class="btn btn-secondary btn-lg">Cancel</a>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>