<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1><?= $feedback["name"]; ?></h1>
    <p><strong>Created At: </strong><?= $feedback["created_at"]; ?></p>
    <div class="form-floating">
        <textarea class="form-control" style="height: 12rem;" disabled><?= $feedback["feedback"]; ?></textarea>
    </div>
    <div class="d-flex gap-2 mt-4">
        <form action="/admin/search/delete" method="GET">
            <input type="hidden" name="feedbackId" value="<?= $feedback["id"]; ?>">
            <button type="submit" class="btn btn-danger">Delete</button>
            <!-- <a href="admin_delete_feedback.php?id=<?= $id; ?>&name=<?= $name; ?>&feedback=<?= $feedback; ?>&createdAt=<?= $createdAtDate ?>" class="btn btn-danger">Delete</a> -->
        </form>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>