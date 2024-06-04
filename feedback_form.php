<?php

session_start();

$successMessage = $_SESSION["successMessage"] ?? "";
$emptyFeedbackError = $_SESSION["errors"]["feedbackEmptyMessage"] ?? "";

session_destroy();
unset($_SESSION);

// TODO: finish feedback form
?>

<?php require_once "src/includes/header.inc.php"; ?>

<div>
    <form action="feedback.php" method="POST">
        <label for="name">Name (Optional)</label>
        <input type="text" name="name">

        <label for="feedbackText">Feedback</label>
        <input type="text" name="feedbackText">

        <p><?= $emptyFeedbackError ?></p>

        <button type="submit">Submit</button>
    </form>
</div>

<?php require_once "src/includes/footer.inc.php"; ?>