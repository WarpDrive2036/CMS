<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>


<div id="page-wrapper">


    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php') ?>

        <form action="/Profile_edit" method="post" enctype="multipart/form-data"> <!-- enctype multiform
  meaning a form that can handle/accepts images-->
            <div class="form-group">
                <label for="title">Edit Profile Firstname</label>
                <input type="text" class="form-control" name="firstname" value="<?=isset($_POST['update_credentials']) ? $_POST['firstname'] : $profile[0]['firstname']?>">
            </div>

            <?php if(isset($_POST['update_credentials'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['firstname']?></b></p>
            <?php endif;?>


            <div class="form-group">
                <label for="post_status">Edit Profile Lastname</label>
                <input type="text" class="form-control" name="lastname" value="<?=isset($_POST['update_credentials'])? $_POST['lastname']:$profile[0]['lastname']?>">
            </div>

            <?php if(isset($_POST['update_credentials'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['lastname']?></b></p>
            <?php endif;?>


            <div class="form-group">
                <label for="profile_image">Edit Profile Image</label>
                <?php if (!empty($profile[0]['user_image'])): ?>
                    <img src="images/<?= $profile[0]['user_image'] ?>" class="img-thumbnail" style="max-width: 150px; height: auto; border-radius: 5px;">
                <?php endif; ?>
                <input type="file" name="image" value="<?= $profile[0]['user_image'] ?>">
            </div>

            <?php if(isset($_POST['update_credentials'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['profile_image']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <label for="post_tags">Edit your Username</label>
                <input type="text" class="form-control" name="username" value="<?= isset($_POST['update_credentials'])? $_POST['username']:$profile[0]['username']?>">
            </div>

            <?php if(isset($_POST['update_credentials'])) :?>
                <b><p style="color: red;"class="text-xs mt-2"><?=$_SESSION['errors']['username']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <label for="post_content">Change your Email</label>
                <input type="email" class="form-control" name="email" value="<?=isset($_POST['update_credentials'])? $_POST['email']:$profile[0]['email']?>">
            </div>

            <?php if(isset($_POST['update_credentials'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['email']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <label for="post_content">Change your Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <?php if(isset($_POST['update_credentials'])) :?>
                <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['password']?></b></p>
            <?php endif;?>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_credentials" value="Edit Profile">
                <input type="hidden" name="_method" value="PATCH">
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
