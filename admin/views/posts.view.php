<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php')?>

        <?php $currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
        $user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';

        ?>

                <style>
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        max-width: 800px;
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

                    .delete-btn {
                        background-color: red;
                        color: white;
                        border: none;
                        padding: 8px 16px;
                        border-radius: 4px;
                        cursor: pointer;
                    }

                    .delete-btn:hover {
                        background-color: darkred;
                    }

                    .edit-btn {
                        background-color: #33a71c;
                        color: white;
                        border: none;
                        padding: 8px 16px;
                        border-radius: 4px;
                        cursor: pointer;
                    }

                    .edit-btn:hover {
                        background-color: #1a73e8;
                    }
                </style>

                <table>
                    <thead>
                    <tr>
                        <th>Post_ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cat_table as $item) :?>
                        <?php if ($currentUserId == $item['post_user_id'] && $user_role == 'subscriber' ) : ?>
                        <tr>
                            <td><?=$item['id']?></td>
                            <td><?=htmlspecialchars($item['post_author'])?></td>
                            <td><?=htmlspecialchars($item['post_title'])?></td>
                            <td><?=htmlspecialchars($item['category_name'])?></td>
                            <td><?=htmlspecialchars($item['post_status']).'ed'?></td>
                            <td>
                                <img src="<?= file_exists('images/'. $item['post_image']) ? 'images/' . $item['post_image'] : $item['post_image'] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td><?=htmlspecialchars($item['post_tags'])?></td>
                            <td><?=$item['post_comment_count']?></td>
                            <td><?=$item['post_date']?></td>
                            <td>
                                <form style="display: inline-block;" action="/post" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="post_id" value="<?=$item['id']?>">
                                    <button class="delete-btn" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                                <form style="display: inline-block;" action="/post" method="post">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="post_id" value="<?=$item['id']?>">
                                    <button class="edit-btn" type="submit">Edit</button>
                                </form>
                            </td>
                        </tr>

                        <?php elseif($user_role == 'admin'): ?>

                            <tr>
                                <td><?=$item['id']?></td>
                                <td><?=htmlspecialchars($item['post_author'])?></td>
                                <td><?=htmlspecialchars($item['post_title'])?></td>
                                <td><?=htmlspecialchars($item['category_name'])?></td>
                                <td><?=htmlspecialchars($item['post_status'].'ed')?></td>
                                <td>
                                    <img src="<?= file_exists('images/'. $item['post_image']) ? 'images/' . $item['post_image'] : $item['post_image'] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                </td>
                                <td><?=htmlspecialchars($item['post_tags'])?></td>
                                <td><?=htmlspecialchars($item['post_comment_count'])?></td>
                                <td><?=htmlspecialchars($item['post_date'])?></td>
                                <td>
                                    <form style="display: inline-block;" action="/post" method="post">
                                        <input type="hidden" name="_method" value="DELETE"> <!-- a hidden variable with a given value
            to be used to detect the type custom Request through the POST['_method'] method already in the form-->
                                        <input type="hidden" name="post_id" value="<?=$item['id']?>">
                                        <button class="delete-btn" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                    <form style="display: inline-block;" action="/post" method="post">
                                        <input type="hidden" name="_method" value="PATCH"> <!-- a hidden variable with a given value
            to be used to detect the type custom Request through the POST['_method'] method already in the form-->
                                        <input type="hidden" name="post_id" value="<?=$item['id']?>">
                                        <button class="edit-btn" type="submit">Edit</button>
                                    </form>
                                </td>
                            </tr>

                   <?php endif;?>
                    <?php endforeach;?>
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

<?php require base_path('admin/partials_admin/footer.php') ?>
