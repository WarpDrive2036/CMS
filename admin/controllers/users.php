<?php require_once base_path('Core/Database.php'); ?>



<?php $config = require base_path('config.php');
$db = new \Core\Database($config['database']);
$users = $db->query('Select * from users;')->get();

//REMEMBER to move this file out of the controllers folder for security reasons (so the user wont be able to
// access the other files located in the same folder unless we authorize him/her)


// dynamic routing to pages through the posts table in the admin Dashboard

// We implement this by listing to the _GET variable & routing it by control statements respectively

if(isset($_GET['source']))
{
    $source = $_GET['source'];
} else {
    $source = '';
}
switch ($source) {
    case 'add_posts';
        require_once 'add_user.php';
        break;

    case 'edit_user';
        require_once 'edit_user.php';
        break;

        default:
        require_once base_path('admin/views/users.view.php');
        break;
}


