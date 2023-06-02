<?php require_once base_path('Core/Database.php'); ?>



<?php $config = require base_path('config.php');
$db = new \Core\Database($config['database']);
$comments = $db->query('SELECT c.*, p.post_title
FROM comments AS c
JOIN posts AS p ON c.comment_post_id = p.id;')->get();

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
        require_once base_path('admin/views/comments.view.php');
        break;
}


