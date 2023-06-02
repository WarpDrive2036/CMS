<?php
require_once base_path('Core/Database.php');

$_SESSION['errors'] = [
    'firstname'=>'',
    'lastname'=>'',
    'profile_image'=>'',
    'username'=>'',
    'email'=>'',
    'password'=>'',
];


$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$user_id = $_SESSION['user']['user_id'];

$profile = $db->query('select * from users where id = ?', [$user_id])->get();

if (isset($_POST['update_credentials'])) {
    $entered_password = $_POST['password'];
    // Validate form fields

    if (empty($_POST['firstname']) || trim($_POST['firstname']) === '') {
        $_SESSION['errors']['firstname'] = 'Enter the UPDATED firstname!';
    }
    if (empty($_POST['lastname']) || trim($_POST['lastname']) === '') {
        $_SESSION['errors']['lastname'] = 'Enter the UPDATED lastname!';
    }
    if (empty($_POST['username']) || trim($_POST['username']) === '') {
        $_SESSION['errors']['username'] = 'Please enter your NEW username!';
    }
    if (empty($_FILES['image']['name'])) {
        $_SESSION['errors']['profile_image'] = 'Please choose your NEW profile image!';
    }
    if (empty($_POST['email']) || trim($_POST['email']) === '') {
        $_SESSION['errors']['email'] = 'Please enter your NEW email!';
    }
    if (password_verify($entered_password, $profile[0]['password'] ?? '')) {
        $_SESSION['errors']['password'] = 'Please enter a new password!';
    } elseif (empty($_POST['password']) || trim($_POST['password']) === '') {
        $_SESSION['errors']['password'] = "Password can't be empty!";
    }



    // Check for errors
    $errors = array_filter($_SESSION['errors']);
    if (!empty($errors))
    {
        // Display errors to user and prevent insert query from being executed
        require_once 'profile.php';

    } else {
        // If there are no errors, insert the post record into the database
        $profile_image = $_FILES['image']['name'];
        $profile_image_temp = $_FILES['image']['tmp_name'];

        $db->query('update users set username = ?, password = ?, firstname = ? , lastname = ?, email = ?, user_image = ? WHERE id = ?',[
            $_POST['username'], password_hash($_POST['password'],PASSWORD_BCRYPT),$_POST['firstname'],$_POST['lastname'],$_POST['email'], $profile_image , $user_id ]);

        move_uploaded_file($profile_image_temp, "images/$profile_image");
        if($_SESSION['user']['role']=='admin') {
            header('location: /Admin_users');
            exit();
        }else {
            header('location: /subscriber');
        }


    }
}

require base_path('admin/views/profile.view.php');

