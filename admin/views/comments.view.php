<?php require base_path('admin/partials_admin/header.php'); ?>
<?php require base_path('admin/partials_admin/nav.php'); ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php'); ?>

                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        max-width: 1200px;
                        margin: auto;
                    }

                    th,
                    td {
                        text-align: center;
                        padding: 8px;
                        border: 1px solid black;
                    }

                    th {
                        background-color: #ddd;
                    }

                    tr:nth-child(even) {
                        background-color: #f2f2f2;
                    }

                    .approve-btn,
                    .unapprove-btn,
                    .delete-btn,
                    .edit-btn {
                        background-color: #33a71c;
                        color: white;
                        border: none;
                        padding: 8px 16px;
                        border-radius: 4px;
                        cursor: pointer;
                        margin-bottom: 10px;
                        display: block;
                        width: 100%;
                    }

                    .approve-btn:hover,
                    .unapprove-btn:hover,
                    .delete-btn:hover,
                    .edit-btn:hover {
                        background-color: #1a73e8;
                    }
                </style>

                <table>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In Response to</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($comments as $comment) : ?>
                        <tr>
                            <td><?= $comment['id'] ?></td>
                            <td><?= htmlspecialchars($comment['comment_author']) ?></td>
                            <td><?= htmlspecialchars($comment['comment_content']) ?></td>
                            <td><?= htmlspecialchars($comment['comment_email']) ?></td>
                            <td><?= $comment['comment_status'] ?></td>
                            <td><a href="/post?id=<?= $comment['comment_post_id'] ?>"><?= $comment['post_title'] ?></a></td>
                            <td><?= $comment['comment_date'] ?></td>
                            <td>
                                <form style="display: inline-block;" action="/comment/authorize" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <input type="hidden" name="status" value="Approved">
                                    <button class="approve-btn" type="submit">Approve</button>
                                </form>

                                <form style="display: inline-block;" action="/comment/authorize" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <input type="hidden" name="status" value="Unapproved">
                                    <button class="unapprove-btn" type="submit">Unapprove</button>
                                </form>

                                <form style="display: inline-block;" action="/comment/delete" method="post">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="delete-btn" type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->

<?php require base_path('admin/partials_admin/footer.php'); ?>
