<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?=require base_path('admin/partials_admin/page_heading.php')?>

        <?php $currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
        $user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';
        ?>
                <!-- FORM for the user to add  Category titles -->
                <div class="col-lg-6">
                    <form method="post" action="/Category">
                        <div class="form-group">
                            <label for="cat-title">Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                        </div>
                        <!-- displays a message when a submit POST request occurs -->
                        <?php if(isset($_POST['submit'])) :?>
                            <b><p class="text-red-500 text-xs mt-2"><?=$_SESSION['errors']?></b></p>
                        <?php endif;?>
                    </form>
                </div>

                <div class="col-xs-6">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($cat_titles as $cat_title) {
                            echo '<tr>';
                            echo '<td>' . $cat_title['id'] . '</td>';
                            echo '<td>' . htmlspecialchars($cat_title['cat_title']) . '</td>';
                            echo '<td>';
                            if ($currentUserId == $cat_title['added_by'] || $user_role == 'admin') {
                                echo '<form method="post" action="/Category">';
                                echo '<input type="hidden" name="id" value="' . $cat_title['id'] . '">';
                                echo '<input type="hidden" name="_method" value="PATCH">';
                                echo '<button type="submit" class="btn btn-primary mr-2">Edit</button>';
                                echo '</form>';
                                echo '<form method="post" action="/Category" onsubmit="return confirm(\'Are you sure you want to delete this category?\')">';
                                echo '<input type="hidden" name="id" value="' . $cat_title['id'] . '">';
                                echo '<input type="hidden" name="_method" value="DELETE">';
                                echo '<button type="submit" class="btn btn-danger">Delete</button>';
                                echo '</form>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                        </tbody>
                    </table>






                </div>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php require base_path('admin/partials_admin/footer.php')?>
