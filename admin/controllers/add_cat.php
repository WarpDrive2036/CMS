<?php require_once base_path('Core/Database.php'); ?>

<?php

$_SESSION['errors'] = '';
$currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';

// if the _POST['cat_title'] array is empty then add an element to the errors array

if(empty($_POST['cat_title']) || trim($_POST['cat_title']) === '')
{
    $_SESSION['errors'] = 'Category can not be empty!';
}

    if (!empty($_SESSION['errors'])) // if Session errors isn't empty we do the following
    {
        require_once  'categories.php';
        require_once  base_path('admin/views/categories.view.php');
        unset($_SESSION['errors']); // Deletes the Session crated in the if statement above
    }
    else {

        //if the errors array is empty then we are good to go & add the user entered query to the DB

        $config = require base_path('config.php');
        $db = new \Core\Database($config['database']);
        $test = $db->query('INSERT INTO categories (cat_title ,added_by) VALUES (?,?)',[$_POST['cat_title'],$currentUserId]);


        header('location: /Admin_Categories'); //re-directs the user to the main notes page
        die();
    }

    ?>






































