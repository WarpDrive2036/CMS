<?php
require_once base_path('Core/Database.php');


$_SESSION['user_id']= isset($_POST['user_id']) ? $_SESSION['user_id'] = $_POST['user_id'] : '';

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


if (isset($_POST['update_credentials'])) {
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
    if (empty($_POST['password']) || trim($_POST['password']) === '') {
        $_SESSION['errors']['password'] = 'Please enter a NEW password!';
    }



    // Check for errors
    $errors = array_filter($_SESSION['errors']);
    if (!empty($errors))
    {
        // Display errors to user and prevent insert query from being executed
        require_once 'update_credentials.php';

    } else {
            // If there are no errors, insert the post record into the database
            $profile_image = $_FILES['image']['name'];
            $profile_image_temp = $_FILES['image']['tmp_name'];

        $db->query('update users set username = ?, password = ?, firstname = ? , lastname = ?, email = ?, user_image = ? WHERE id = ?',[
           $_POST['username'], password_hash($_POST['password'],PASSWORD_BCRYPT),$_POST['firstname'],$_POST['lastname'],$_POST['email'], $profile_image , $_POST['user_id'] ]);

        move_uploaded_file($profile_image_temp, "images/$profile_image");
            header('location: /Admin_users');
            exit();
        }
    }


require_once base_path('admin/views/update_credentials.view.php');
