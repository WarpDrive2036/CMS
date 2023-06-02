<?php require_once base_path('Core/Database.php'); ?>

<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$result = ($db->query('SELECT * from posts where id = ?',[$_POST['post_id']]))->find();

if(!$result) {
    header('location: /Admin_Posts');
    exit();
} else

{
    $db->query('delete from posts where id = ?',[$_POST['post_id']]);

//re-directs the user to the main notes page
    header('location: /Admin_Posts');
    exit();
}

?>






































