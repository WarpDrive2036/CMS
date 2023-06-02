<?php require base_path('admin/partials_admin/header.php')?>
<?php require base_path('admin/partials_admin/nav.php') ?>
<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php') ?>

<form action="" method="post" enctype="multipart/form-data"> <!-- enctype multiform
  meaning a form that can handle/accepts images-->

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <?php if(isset($_POST['create_user'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['firstname']?></b></p>
    <?php endif;?>


    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="lastname">
    </div>

    <?php if(isset($_POST['create_user'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['lastname']?></b></p>
    <?php endif;?>

    <!-- The code generates a drop-down list of categories -->
    <div class="form-group">
        <label for="title">Select Role</label>
        <select name="user_role"> <!-- The name of the "input" but in select element its "value"
                         must match the name-->
            <option value="subscriber"> Select Options </option>

            <option value="admin"> Admin </option>

            <option value="subscriber"> Subscriber </option>

        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Profile Image</label>
        <input type="file" name="image">
    </div>

    <?php if(isset($_POST['create_user'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['profile_image']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <?php if(isset($_POST['create_user'])) :?>
        <b><p style="color: red;"class="text-xs mt-2"><?=$_SESSION['errors']['username']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="email">
    </div>

    <?php if(isset($_POST['create_user'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['email']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <?php if(isset($_POST['create_user'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['password']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
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
