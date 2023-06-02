<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>
<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$post_id = $_SESSION['id'];


$post = $db->query('select * from posts where id = ?', [$post_id])->get();

$cat_titles = $db->query('SELECT * FROM categories')->get();

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php')?>

                <form action="/post" method="post" enctype="multipart/form-data"> <!-- enctype multiform
  meaning a form that can handle/accepts images-->

                    <div class="form-group">
                        <?php if (empty($errors) && isset($_POST['edit_post'])) : ?>
                            <b>
                                <p class="bg-success">
                                    Post Updated Successfully
                                    <a href="<?='/post?id=' . $post[0]['id'] ?>"><?=$post[0]['post_status']=='Draft' ? '' :'View Post'?> </a>
                                     <?=$post[0]['post_status']=='Draft' ? '' : 'or'?> <a href="/Admin_Posts">Edit More Posts</a>
                                </p>
                            </b>
                        <?php endif; ?>

                        <label for="title">Post Title</label>
                        <input type="text" class="form-control" name="title" value="<?=$post[0]['post_title']?>">
                    </div>
                    <!-- displays a message when a submit POST request occurs -->
                    <?php if(isset($_POST['edit_post'])) :?>
                        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_title']?></p></b>
                    <?php endif;?>

                    <!-- The code generates a drop-down list of categories and sets the default selection based
                    on the category of the post being edited.  -->
                    <div class="form-group">
                        <label for="title">Select Category</label>
                        <select name="post_category_id"> <!-- The name of the "input" but in select element its "value"
                         must match the name-->
                            <?php foreach ($cat_titles as $cat_title): ?>
                                <option value="<?= $cat_title['id'] ?>" <?php if($cat_title['id'] == $post[0]['post_category_id']) echo 'selected'; ?>>
                                    <?= $cat_title['cat_title'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="title">Post Author</label>
                        <input type="text" class="form-control" name="author" value="<?=$post[0]['post_author']?>">
                    </div>

                    <?php if(isset($_POST['edit_post'])) :?>
                        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_author']?></b></p>
                    <?php endif;?>


                    <!-- The code generates a drop-down list to set the Status of the post -->
                    <div class="form-group">
                        <label for="title">Select Status</label>
                        <select name="post_status"> <!-- The name of the "input" but in select element -->
                            <option value="Publish" <?= $post[0]['post_status'] == 'Publish' ? 'selected' : '' ?>>
                                Publish
                            </option>
                            <option value="Draft" <?= $post[0]['post_status'] == 'Draft' ? 'selected' : '' ?>>
                                Draft
                            </option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="post_image">Post Image</label>
                        <?php if (!empty($post[0]['post_image'])): ?>
                            <img src="../../images/<?= $post[0]['post_image'] ?>" class="img-thumbnail" style="max-width: 150px; height: auto; border-radius: 5px;">
                        <?php endif; ?>
                        <input type="file" name="image" value="<?= $post[0]['post_image'] ?>">
                    </div>


                    <?php if(isset($_POST['edit_post'])) :?>
                        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_image']?></b></p>
                    <?php endif;?>

                    <div class="form-group">
                        <label for="post_tags">Post Tags</label>
                        <input type="text" class="form-control" name="post_tags" value="<?=$post[0]['post_tags']?>">
                    </div>

                    <?php if(isset($_POST['edit_post'])) :?>
                        <b><p style="color: red;"class="text-xs mt-2"><?=$_SESSION['errors']['post_tags']?></b></p>
                    <?php endif;?>

                    <div class="form-group">
                        <label for="summernote">Post Content</label>
                        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?= $post[0]['post_content'] ?></textarea>
                    </div>


                    <?php if(isset($_POST['edit_post'])) :?>
                        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['post_content']?></b></p>
                    <?php endif;?>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post" onclick="document.getElementsByName('post_id')[0].value = '<?=$post[0]['id']?>';">
                    </div>
                    <input type="hidden" name="post_id" value="">
                    <input type="hidden" name="_method" value="PATCH">

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
