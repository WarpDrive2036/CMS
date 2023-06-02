<?php

require_once base_path('Core/Database.php');

$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$result = ($db->query('SELECT * from comments where id = ?',[$_POST['comment_id']]))->find();

if(!$result) {
    header('location: /Admin_comments');
    exit();
} else

{
    $db->query('delete from comments where id = ?',[$_POST['comment_id']]);

//re-directs the user to the main comments page
    header('location: /Admin_comments');
    exit();
}