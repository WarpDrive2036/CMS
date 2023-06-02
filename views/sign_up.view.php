<?php require base_path('partials/header.php')?>
<?php require base_path('partials/nav.php') ?>
<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <?php require base_path('partials/sign-up_heading.php')?>

        <form action="" method="post" enctype="multipart/form-data"> <!-- enctype multiform
  meaning a form that can handle/accepts images-->

            <div class="form-group">
                <label for="title">Firstname</label>
                <input type="text" class="form-control" name="firstname" value="<?=isset($_POST['create_user'])? $_POST['firstname']:''?>">
            </div>

            <?php if(isset($_POST['create_user'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['firstname']?></b></p>
            <?php endif;?>


            <div class="form-group">
                <label for="post_status">Lastname</label>
                <input type="text" class="form-control" name="lastname" value="<?=isset($_POST['create_user'])? $_POST['lastname']:''?>">
            </div>

            <?php if(isset($_POST['create_user'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['lastname']?></b></p>
            <?php endif;?>


            <div class="form-group">
                <label for="post_image">Profile Image</label>
                <input type="file" name="image">
            </div>

            <?php if(isset($_POST['create_user'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['profile_image']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <label for="post_tags">Username</label>
                <input type="text" class="form-control" name="username" value="<?=isset($_POST['create_user'])? $_POST['username']:''?>">
            </div>

            <?php if(isset($_POST['create_user'])) :?>
                <b><p style="color: red;"class="text-xs mt-2"><?=$_SESSION['errors']['username']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <label for="post_content">Email</label>
                <input type="email" class="form-control" name="email" value="<?=isset($_POST['create_user'])? $_POST['email']:''?>">
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
                <label for="post_content">Enter Password again</label>
                <input type="password" class="form-control" name="password_again">
            </div>

            <?php if(isset($_POST['create_user'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['password_again']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="create_user" value="Register">
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
<?php require base_path('partials/footer.php') ?>
