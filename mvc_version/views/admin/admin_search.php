<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4 form-floating">
            <input type="text" name="search_text" class="form-control w-75" value="<?= $_GET["search_text"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary w-25">Search text</button>
            <label for="search_text">Text</label>
        </div>
    </form>

    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4 form-floating">
            <input type="month" name="search_month_and_year" class="form-control w-75" value="<?= $_GET["search_month_and_year"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary w-25">Search month & year</button>
            <label for="search_month_and_year">Month and Year</label>
        </div>
    </form>

    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4 form-floating">
            <input type="date" name="search_date" class="form-control w-75" value="<?= $_GET["search_date"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary w-25">Search date</button>
            <label for="search_date">Date</label>
        </div>
    </form>

    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4 form-floating">
            <select id="categorySelect" name="searchCategory" class="form-select w-75">
                <option value="all" <?= isset($_GET["searchCategory"]) && $_GET["searchCategory"] == "all" ? "selected" : ""; ?>>All</option>
                <option value="books" <?= isset($_GET["searchCategory"]) && $_GET["searchCategory"] == "books" ? "selected" : ""; ?>>Books</option>
                <option value="facilities" <?= isset($_GET["searchCategory"]) && $_GET["searchCategory"] == "facilities" ? "selected" : ""; ?>>Facilities</option>
                <option value="staff" <?= isset($_GET["searchCategory"]) && $_GET["searchCategory"] == "staff" ? "selected" : ""; ?>>Staff</option>
                <option value="misc" <?= isset($_GET["searchCategory"]) && $_GET["searchCategory"] == "misc" ? "selected" : ""; ?>>Miscellaneous</option>
            </select>
            <label for="categorySelect">Category</label>

            <button type="submit" class="btn btn-primary w-25">Search category</button>
        </div>
    </form>

    <?php if (!empty($matchedFeedback)): ?>
        <table class="table mt-4">
            <thead>
                <th scope="col">Name</th>
                <th scope="col">Feedback</th>
                <th scope="col">Category</th>
                <th scope="col">Created At</th>
                <th scope="col"></th>
            </thead>
            <tbody>
                <?php foreach ($matchedFeedback as $feedback): ?>
                    <tr>
                        <td><?= $feedback["name"]; ?></td>
                        <td><?= substr($feedback["feedback"], 0, 20) . "..."; ?></td>
                        <td><?= $feedback["category"]; ?></td>
                        <td><?= $feedback["created_at"]; ?></td>
                        <td>
                            <a href="/admin/search/details?feedbackId=<?= $feedback["id"]; ?>" class="btn btn-primary">Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No matches found.</p>
    <?php endif; ?>
</div>

<?php require_once "includes/admin_footer.php"; ?>