<?php

$_SESSION['errors'] = '';

require_once base_path('/Core/Database.php');

$config = require base_path('/config.php');
$db = new \Core\Database($config['database']);

$entered_password = $_POST['password'] ?? '';

// check the entered credintials if existent in the users DB & if not we display the proper message

$user_exist = $db->query('select * from users where username = ?',[$_POST['username'] ??''])->find();


if (empty($_POST['username']) || trim($_POST['username']) === '')
{
    $_SESSION['errors'] = 'Please enter your Username & Password!';
    require_once base_path('index.php');
}

if(!$user_exist)
{
    $_SESSION['errors'] = "User Doesn't Exist!";
    require_once base_path('index.php');

}
if (!password_verify($entered_password, $user_exist['password'] ?? ''))
{
    $_SESSION['errors'] = "The Entered Username or Password are Incorrect!";
    require_once base_path('index.php');
}else
{
    // if all is good then create a user session that caches all current user data
    $_SESSION['user'] = [
        'user_id' => $user_exist['id'],
        'username'=>$user_exist['username'],
        'firstname'=>$user_exist['firstname'],
        'lastname'=>$user_exist['lastname'],
        'email'=>$user_exist['email'],
        'role'=>$user_exist['role'],
        'user_image'=>$user_exist['user_image'],
    ];
    header('location: /');
    exit();
}

require_once base_path('index.php');






