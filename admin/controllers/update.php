<?php require_once base_path('Core/Database.php') ?>


<?php
$_SESSION['errors_update'] = '';
require base_path('admin/views/edit_cat.view.php');

$config = require base_path('config.php');
$db = new \Core\Database($config['database']);


// if the _POST['cat_title'] array is empty then add an element to the errors array
if(empty($_POST['cat_title']) || trim($_POST['cat_title']) === '')
{
    $_SESSION['errors_update'] = 'Category can not be empty!';
}
// if there is Validation errors (errors array not empty) we reload the view

if (!empty($_SESSION['errors_update'])) // if Session errors isn't empty we do the following
{
    require_once  'update.php';

    unset($_SESSION['errors_update']); // Deletes the Session crated in the if statement above
}
else {

    //if the errors array is empty then we are good to go & add the user entered query to the DB


    //if the errors array is empty then we are good to go & we can proceed to "UPDATE" the user entered query to the DB
    $db->query('update categories set cat_title = :cat_title where id = :id',[
        'id'=>$_POST['id'],
        'cat_title'=>$_POST['cat_title']
    ]);
        // redirect the user to categories.php after the update is successful
        header('Location: /Admin_Categories');
        exit();
}









