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

$username_exist = $db->query('Select * from users where username = ?',[$_POST['username'] ?? ''])->find();


if (isset($_POST['status'])) {
    $db->query('UPDATE users SET role = :role WHERE id = :id', [
        'id' => $_POST['user_id'],
        'role' => $_POST['user_role']
    ]);
    header('location: /Admin_users');
    exit();
}



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

    // Check for errors
    $errors = array_filter($_SESSION['errors']);
    if (!empty($errors))
    {
        // Display errors to user and prevent insert query from being executed
        require_once 'add_users.php';

    } else {
            // If there are no errors, insert the post record into the database
            $profile_image = $_FILES['image']['name'];
            $profile_image_temp = $_FILES['image']['tmp_name'];

            $db->query('INSERT INTO users (username, password, firstname, lastname, email, user_image, role) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                $_POST['username'], password_hash($_POST['password'],PASSWORD_BCRYPT), $_POST['firstname'], $_POST['lastname'], $_POST['email'], $profile_image, $_POST['user_role']]);
            move_uploaded_file($profile_image_temp, "images/$profile_image");
            header('location: /Admin_users');
            exit();
        }
    }


require_once base_path('admin/views/add_users.view.php');
