<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Are you sure you want to delete this entry?</h1>
    <hr>
    <h1><?= $feedback["name"]; ?></h1>
    <p><strong>Created At: </strong><?= $feedback["created_at"]; ?></p>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $feedback["feedback"]; ?></textarea>
    </div>

    <form action="/admin/search/delete" method="POST" class="mt-3">
        <input type="hidden" name="feedbackId" value="<?= $feedback["id"]; ?>">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>