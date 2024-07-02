<?php require_once "includes/feedback_header.php"; ?>

<div class="container mt-4">
    <h1>Submit Feedback</h1>
    <form action="/feedback/create" method="POST">
        <div class="form-floating mb-3">
            <input type="text" id="name" name="name" placeholder="Enter name here" class="form-control" value="<?= $feedback["name"] ?? "" ?>">
            <label for="name">Name (Optional)</label>
        </div>

        <div class="form-floating mb-3">
            <select id="categorySelect" name="categorySelect" class="form-select">
                <option value="books" selected>Books</option>
                <option value="staff">Staff</option>
                <option value="facilities">Facilities</option>
                <option value="misc">Miscellaneous</option>
            </select>
            <label for="categorySelect">Category</label>
        </div>

        <div class="form-floating mb-3">
            <textarea id="feedbackText" name="feedbackText" placeholder="Enter feedback here" class="form-control" style="height: 200px;"></textarea>
            <label for="feedbackText">Feedback</label>
        </div>

        <?php if (isset($errors["feedbackTextError"])): ?>
            <div class="alert alert-danger">
                <?= $errors["feedbackTextError"]; ?>
            </div>
        <?php elseif (!isset($errors)): ?>
            <div class="alert alert-success">
                <?= "Feedback submitted!"; ?>
            </div>
        <?php endif; ?>

        <button type="submit" name="feedback_submit" value="submit" class="btn btn-primary btn-lg">Submit</button>
    </form>
</div>

<?php require_once "includes/feedback_footer.php"; ?>