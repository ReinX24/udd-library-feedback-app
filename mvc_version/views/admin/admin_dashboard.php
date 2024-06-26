<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <img src="/images/udd_logo.png" class="mb-4" width="200" height="200">
            <h1 class="text-body-emphasis">UdD Library Suggestions Admin Panel</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Admin Panel for accessing UdD Library Suggestions entries and Admin accounts.
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                <a href="/admin/search">
                    <button class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                        Search Feedback
                    </button>
                </a>
                <a href="src/admin_panel.php?page=admin_accounts">
                    <button class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                        Add Admin Account
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>