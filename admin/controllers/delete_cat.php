<?php require_once base_path('Core/Database.php'); ?>

<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$result = ($db->query('SELECT * from categories where id = ?',[$_POST['id']]))->find();

if(!$result) {
    header('location: /Admin_Categories');
    exit();
} else

{
    $db->query('delete from categories where id = ?',[$_POST['id']]);

//re-directs the user to the main notes page
    header('location: /Admin_Categories');
    exit();
}

?>






































