<?php

declare(strict_types=1);

?>

<?php require_once "src/includes/header.inc.php"; ?>

<div class="container my-5">
    <div class="p-5 text-center bg-body-tertiary rounded-3">
        <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100">
            <use xlink:href="#bootstrap" />
        </svg>
        <h1 class="text-body-emphasis">Library Feedback Form</h1>
        <p class="col-lg-8 mx-auto fs-5 text-muted">
            Submit feedback or suggestions for improving the library of Universidad de Dagupan.
            Any feedback is appreciated!
        </p>
        <div class="d-inline-flex gap-2 mb-5">
            <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                Submit Feedback
            </button>
            <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                Admin Login
            </button>
        </div>
    </div>
</div>


<?php require_once "src/includes/footer.inc.php"; ?>