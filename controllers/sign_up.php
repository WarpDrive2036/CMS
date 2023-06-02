<?php

require_once base_path('Core/Database.php');


$_SESSION['errors'] = [
    'firstname'=>'',
    'lastname'=>'',
    'profile_image'=>'',
    'username'=>'',
    'email'=>'',
    'password'=>'',
    'password_again'=>''
];


$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$username_exist = $db->query('Select * from users where username = ?',[$_POST['username'] ?? ''])->find();

if (isset($_POST['create_user'])) {
    // Validate form fields
    if (empty($_POST['firstname']) || trim($_POST['firstname']) === '') {
        $_SESSION['errors']['firstname'] = 'Please enter your firstname!';
    }
    if (empty($_POST['lastname']) || trim($_POST['lastname']) === '') {
        $_SESSION['errors']['lastname'] = 'Please enter your lastname!';
    }
    if (empty($_POST['username']) || trim($_POST['username']) === '' ) {
        $_SESSION['errors']['username'] = 'Please enter your username!';
    }
    if ($username_exist) {
        $_SESSION['errors']['username'] = 'This Username already exists!';
    }
    if (empty($_FILES['image']['name'])) {
        $_SESSION['errors']['profile_image'] = 'Please choose your profile image!';
    }
    if (empty($_POST['email']) || trim($_POST['email']) === '') {
        $_SESSION['errors']['email'] = 'Please enter your email!';
    }
    if (empty($_POST['password']) || trim($_POST['password']) === '') {
        $_SESSION['errors']['password'] = 'Please enter a password!';
    }
    if (empty($_POST['password_again']) || trim($_POST['password_again']) === '') {
        $_SESSION['errors']['password_again'] = 'Please Re-enter the password!';
    }
    if (($_POST['password_again']) !==  ($_POST['password'])) {
        $_SESSION['errors']['password_again'] = "Password doesn't match!";
    }

    // Check for errors
    $errors = array_filter($_SESSION['errors']);
    if (!empty($errors))
    {
        // Display errors to user and prevent insert query from being executed
        require_once 'sign_up.php';

    } else {
            // If there are no errors, insert the post record into the database
            $profile_image = $_FILES['image']['name'];
            $profile_image_temp = $_FILES['image']['tmp_name'];

            $db->query('INSERT INTO users (username, password, firstname, lastname, email, user_image, role) VALUES (?, ?, ?, ?, ?, ?, "subscriber")', [
                $_POST['username'], password_hash($_POST['password'],PASSWORD_BCRYPT), $_POST['firstname'], $_POST['lastname'], $_POST['email'], $profile_image]);
            move_uploaded_file($profile_image_temp, "images/$profile_image");

        $registered_user = $db->query('select * from users where username = ?',[$_POST['username'] ??''])->find();

            $_SESSION['user'] = [
            'user_id' => $registered_user['id'],
            'username'=>$registered_user['username'],
            'firstname'=>$registered_user['firstname'],
            'lastname'=>$registered_user['lastname'],
            'email'=>$registered_user['email'],
            'role'=>$registered_user['role'],
            'user_image'=>$registered_user['user_image'],
        ];
        header('location: /');
        exit();
        }
    }


require_once base_path('views/sign_up.view.php');
