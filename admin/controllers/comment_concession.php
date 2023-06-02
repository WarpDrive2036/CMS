<?php

require_once base_path('Core/Database.php');


$config = require base_path('config.php');
$db = new \Core\Database($config['database']);


if ($_POST['status']=='Approved')
{
//    dd('add a query to approve');

    $db->query('update comments set comment_status = :comment_status where id = :id',[
        'id'=>$_POST['comment_id'],
        'comment_status'=>$_POST['status']
    ]);

    header('location: /Admin_comments');
    exit();
}
else if ($_POST['status']== 'Unapproved')
{
//    dd('Add a query to unapprove!');

    $db->query('update comments set comment_status = :comment_status where id = :id',[
        'id'=>$_POST['comment_id'],
        'comment_status'=>$_POST['status']
    ]);

    header('location: /Admin_comments');
    exit();
}


