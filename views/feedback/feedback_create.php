<?php require_once "includes/feedback_header.php"; ?>

<div class="container mt-4">
    <h1>Submit Feedback</h1>
    <form action="/feedback/create" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label fs-5">Name (Optional)</label>
            <input type="text" name="name" placeholder="Enter name here" class="form-control form-control-lg" value="<?= $feedback["name"] ?? "" ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fs-5" for="categorySelect">Category</label>
            <select name="categorySelect" class="form-select form-select-lg">
                <option value="books" selected>Books</option>
                <option value="staff">Staff</option>
                <option value="facilities">Facilities</option>
                <option value="miscellaneous">Miscellaneous</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="feedbackText" class="form-label fs-5">Feedback</label>
            <textarea name="feedbackText" placeholder="Enter feedback here" class="form-control fs-5" style="height: 12rem"></textarea>
        </div>

        <?php if (isset($errors["feedbackTextError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["feedbackTextError"]; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET["added_feedback"])): ?>
            <div class="alert alert-success fs-5">
                <?= "Feedback submitted!"; ?>
            </div>
        <?php endif; ?>

        <button type="submit" name="feedback_submit" value="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
</div>

<?php require_once "includes/feedback_footer.php"; ?>