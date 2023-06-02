<?php require_once  base_path('Core/Database.php');?>


<?php $config = require base_path('config.php');
$db = new \Core\Database($config['database']);
$cat_table = $db->query(
    "SELECT p.*, c.cat_title AS category_name, u.id AS user_id, u.username AS username
     FROM posts AS p 
     JOIN categories AS c ON p.post_category_id = c.id
     JOIN users AS u ON p.post_user_id = u.id;")->get();


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
            require_once 'add_posts.php';
        break;

        case '35';
        echo 'Page 35';
        break;

        case '36';
        echo 'Page 36';
        break;

        default:
            require_once base_path('admin/views/posts.view.php');
            break;
}


