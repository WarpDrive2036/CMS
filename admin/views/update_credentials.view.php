<?php require base_path('admin/partials_admin/header.php') ?>
<?php require base_path('admin/partials_admin/nav.php') ?>
<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);
$user_id = $_SESSION['user_id'];

$users = $db->query('select * from users where id = ?', [$user_id])->get();
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <?php require base_path('admin/partials_admin/page_heading.php') ?>

<form action="/User_update" method="post" enctype="multipart/form-data"> <!-- enctype multiform
  meaning a form that can handle/accepts images-->

    <div class="form-group">
        <label for="title">Update Firstname</label>
        <input type="text" class="form-control" name="firstname" value="<?=isset($_POST['update_credentials'])? $_POST['firstname']:$users[0]['firstname']?>">
    </div>

    <?php if(isset($_POST['update_credentials'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['firstname']?></b></p>
    <?php endif;?>


    <div class="form-group">
        <label for="post_status">Update Lastname</label>
        <input type="text" class="form-control" name="lastname" value="<?=isset($_POST['update_credentials'])? $_POST['lastname']:$users[0]['lastname']?>">
    </div>

    <?php if(isset($_POST['update_credentials'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['lastname']?></b></p>
    <?php endif;?>


    <div class="form-group">
        <label for="profile_image">Change Profile Image</label>
        <?php if (!empty($users[0]['user_image'])): ?>
            <img src="../../images/<?= $users[0]['user_image'] ?>" class="img-thumbnail" style="max-width: 150px; height: auto; border-radius: 5px;">
        <?php endif; ?>
        <input type="file" name="image" value="<?= $users[0]['user_image'] ?>">
    </div>

    <?php if(isset($_POST['update_credentials'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['profile_image']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_tags">Change Username</label>
        <input type="text" class="form-control" name="username" value="<?= isset($_POST['update_credentials'])? $_POST['username']:$users[0]['username']?>">
    </div>

    <?php if(isset($_POST['update_credentials'])) :?>
        <b><p style="color: red;"class="text-xs mt-2"><?=$_SESSION['errors']['username']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_content">Change Email</label>
        <input type="email" class="form-control" name="email" value="<?=isset($_POST['update_credentials'])? $_POST['email']:$users[0]['email']?>">
    </div>

    <?php if(isset($_POST['update_credentials'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['email']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <label for="post_content">Change Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <?php if(isset($_POST['update_credentials'])) :?>
        <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']['password']?></b></p>
    <?php endif;?>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_credentials" value="Update Credentials">
        <input type="hidden" name="_method" value="PATCH">
        <input class="btn btn-primary" type="hidden" name="user_id" value="<?=$user_id?>">
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
