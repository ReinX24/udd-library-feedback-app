<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="src/css_bootstrap/bootstrap.min.css">
</head>

<body>
    <main>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin_panel_index.php">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage == "adminIndex" ? "active" : ""; ?>" href="src/admin_panel.php?page=index">Home</a>
                        </li>
                        <li>
                            <a class="nav-link <?= $currentPage == "adminSearch" ? "active" : ""; ?>" href="src/admin_panel.php?page=search">Search</a>
                        </li>
                        <li>
                            <a class="nav-link <?= $currentPage == "adminAdd" ? "active" : ""; ?>" href="src/admin_panel.php?page=admin_accounts">Admin Accounts</a>
                        </li>
                    </ul>
                    <form action="admin_logout.php" method="POST">
                        <button type="submit" name="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </nav>