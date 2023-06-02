<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>
<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);
$cat_titles = $db->query('SELECT * FROM categories')->get();

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
       <?php require base_path('admin/partials_admin/page_heading.php')?>

<form action="/Add_post" method="post" enctype="multipart/form-data"> <!-- enctype multiform
  meaning a form that can handle/accepts images-->

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <!-- displays a message when a submit POST request occurs -->
    <?php if(isset($_POST['create_post'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_title']?></p></b>
    <?php endif;?>

    <!-- The code generates a drop-down list of categories -->
    <div class="form-group">
        <label for="title">Select Category</label>
        <select name="post_category_id"> <!-- The name of the "input" but in select element its "value"
                         must match the name-->
            <?php foreach ($cat_titles as $cat_title): ?>
                <option value="<?= $cat_title['id'] ?>">
                    <?= $cat_title['cat_title'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <?php if(isset($_POST['create_post'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_author']?></b></p>
    <?php endif;?>


    <!-- The code generates a drop-down list to set the Status of the post -->
    <div class="form-group">
        <label for="title">Select Status</label>
        <select name="post_status"> <!-- The name of the "input" but in select element -->
            <option value="Publish">
                  Publish
                </option>
            <option value="Draft">
                Draft
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <?php if(isset($_POST['create_post'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_image']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <?php if(isset($_POST['create_post'])) :?>
        <b><p style="color: red;"class="text-xs mt-2"><?=$_SESSION['errors']['post_tags']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10">
        </textarea>
    </div>

    <?php if(isset($_POST['create_post'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_content']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</form>



            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->

<?php require base_path('admin/partials_admin/footer.php') ?>
