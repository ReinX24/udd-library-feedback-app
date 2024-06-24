<?php require_once "includes/feedback_header.php"; ?>

<div class="container mt-4">
    <h1>Submit Feedback</h1>
    <form action="/feedback/create" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name (Optional)</label>
            <input type="text" name="name" class="form-control" value="<?= $feedback["name"] ?>">
        </div>

        <div class="mb-3">
            <label for="feedbackText" class="form-label">Feedback</label>
            <textarea name="feedbackText" class="form-control" style="height: 200px;"></textarea>
        </div>

        <?php if (isset($errors["feedbackTextError"])) : ?>
            <div class="alert alert-danger">
                <?= $errors["feedbackTextError"]; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-success">
                <?= "Feedback submitted!"; ?>
            </div>
        <?php endif; ?>

        <button type="submit" name="feedback_submit" value="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
</div>

<?php require_once "includes/feedback_footer.php"; ?>