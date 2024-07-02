<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <h1>Submit Feedback</h1>
    <form action="/admin/search/edit" method="POST">
        <div class="form-floating mb-3">
            <input type="text" id="name" name="name" placeholder="Enter name here" class="form-control" value="<?= $feedback["name"] ?? "" ?>">
            <label for="name">Name (Optional)</label>
        </div>

        <div class="form-floating mb-3">
            <select id="categorySelect" name="categorySelect" class="form-select">
                <option value="books" <?= $feedback["category"] == "books" ? "selected" : ""; ?>>Books</option>
                <option value="facilities" <?= $feedback["category"] == "facilities" ? "selected" : ""; ?>>Facilities</option>
                <option value="staff" <?= $feedback["category"] == "staff" ? "selected" : ""; ?>>Staff</option>
                <option value="misc" <?= $feedback["category"] == "misc" ? "selected" : ""; ?>>Miscellaneous</option>
            </select>
            <label for="categorySelect">Category</label>
        </div>

        <div class="form-floating mb-3">
            <textarea id="feedbackText" name="feedbackText" placeholder="Enter feedback here" class="form-control" style="height: 200px;"><?= $feedback["feedback"] ?></textarea>
            <label for="feedbackText">Feedback</label>
        </div>

        <?php if (isset($errors["feedbackTextError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["feedbackTextError"]; ?>
            </div>
        <?php endif; ?>

        <input type="hidden" name="id" value="<?= $feedback["id"]; ?>">
        <input type="hidden" name="created_at" value="<?= $feedback["created_at"]; ?>">

        <button type="submit" name="feedback_submit" value="submit" class="btn btn-primary btn-lg">Apply</button>
        <a href="/admin/search/details?feedbackId=<?= $feedback["id"]; ?>" class="btn btn-secondary btn-lg">Cancel</a>
    </form>
</div>

<?php require_once "includes/admin_footer.php"; ?>