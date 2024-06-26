<?php require_once "includes/admin_header.php"; ?>

<div class="container mt-4">
    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4">
            <input type="text" name="search_text" class="form-control w-75" placeholder="Search feedback text" value="<?= $_GET["search_text"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary w-25">Search text</button>
        </div>
    </form>

    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4">
            <input type="month" name="search_month_and_year" class="form-control w-75" value="<?= $_GET["search_month_and_year"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary w-25">Search month & year</button>
        </div>
    </form>

    <form action="/admin/search" method="GET">
        <div class="d-flex gap-2 my-4">
            <input type="date" name="search_date" class="form-control w-75" value="<?= $_GET["search_date"] ?? ""; ?>">
            <button type="submit" class="btn btn-primary w-25">Search date</button>
        </div>
    </form>

    <?php if (!empty($matchedFeedback)) : ?>
        <table class="table mt-4">
            <thead>
                <th scope="col">Name</th>
                <th scope="col">Feedback</th>
                <th scope="col">Created At</th>
                <th scope="col"></th>
            </thead>
            <tbody>
                <?php foreach ($matchedFeedback as $feedback) : ?>
                    <tr>
                        <td><?= $feedback["name"]; ?></td>
                        <td><?= substr($feedback["feedback"], 0, 20) . "..."; ?></td>
                        <td><?= $feedback["created_at"]; ?></td>
                        <td>
                            <a href="src/admin_panel.php?
                            getDetails=true
                            &feedbackId=<?= $feedback["id"]; ?>
                            &page=detailsPage" target="_blank" class="btn btn-primary">Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No matches found.</p>
    <?php endif; ?>
</div>

<?php require_once "includes/admin_footer.php"; ?>