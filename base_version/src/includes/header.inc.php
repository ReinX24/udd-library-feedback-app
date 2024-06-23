<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback App</title>
    <link rel="stylesheet" href="src/css_bootstrap/bootstrap.min.css">
</head>

<body>
    <main>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Universidad de Dagupan</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage == "index" ? "active" : ""; ?>" href="index.php">Home</a>
                        </li>
                        <li>
                            <a class="nav-link <?= $currentPage == "feedbackForm" ? "active" : ""; ?>" href="feedback_form.php">Submit Feedback</a>
                        </li>
                        <li>
                            <a class="nav-link <?= $currentPage == "adminLoginForm" ? "active" : ""; ?>" href="admin_login_form.php">Admin Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>