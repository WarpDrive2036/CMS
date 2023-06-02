<?php require base_path('admin/partials_admin/header.php'); ?>
<?php require base_path('admin/partials_admin/nav.php'); ?>
<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);
$_SESSION['cat_title_tobe_Changed '] = ($db->query('select * from categories where id = ?',[$_POST['id']]))->find();

$currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
$user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome Admin
                    <small>John Doe</small>
                </h1>

                <!-- FORM for the user to add Category titles -->
                <div class="col-lg-6">
                    <form method="post" action="/Category">
                        <div class="form-group">
                            <label for="cat-title">Category</label>
                            <input type="text" class="form-control" name="cat_title" value="<?=isset($_SESSION['cat_title_tobe_Changed ']) ? $_SESSION['cat_title_tobe_Changed ']['cat_title'] : ''?>">
                            <input type="hidden" name="id" value="<?=isset($_SESSION['cat_title_tobe_Changed ']) ? $_SESSION['cat_title_tobe_Changed ']['id'] : ''?>">
                            <?php unset($_SESSION['cat_title_tobe_Changed ']);?>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="submit" class="btn btn-primary" name="submit" value="Edit Category">
                        </div>

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
                        $cat_titles = $db->query('SELECT * FROM categories')->get();
                        foreach ($cat_titles as $cat_title) {
                            echo '<tr>';
                            echo '<td>' . $cat_title['id'] . '</td>';
                            echo '<td>' . $cat_title['cat_title'] . '</td>';
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








































