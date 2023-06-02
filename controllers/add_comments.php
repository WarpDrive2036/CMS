<?php

$_SESSION['errors'] = [
    'comment_author'=>'',
    'comment_email'=>'',
    'comment_content'=>'',

];

require_once base_path('/Core/Database.php');


$config = require base_path('config.php');
$db = new \Core\Database($config['database']);


if (isset($_POST['create_comment'])) {

    // Validate other form fields

    if (empty($_POST['comment_author']) || trim($_POST['comment_author']) === '') {
        $_SESSION['errors']['comment_author'] = 'Please enter your name/nick-name!';
    }
    if (empty($_POST['comment_email']) || trim($_POST['comment_email']) === '') {
        $_SESSION['errors']['comment_email'] = 'Please Enter your email';
    }
    if (empty($_POST['comment_content']) || trim($_POST['comment_content']) === '') {
        $_SESSION['errors']['comment_content'] = 'Please enter a comment!';
    }

    // Check for errors
    $errors = array_filter($_SESSION['errors']);
    if (!empty($errors))
    {
        // Display errors to user and prevent insert query from being executed
        header("Location: ../post?id=" . $_POST['post_id']);
        exit;

    } else {
        // If there are no errors, insert the post record into the database
        $current_date = date('Y-m-d H:i:s');
        $db->query('INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) VALUES (?,?, ?, ?,?,?)', [
            $_POST['post_id'],$_POST['comment_author'], $_POST['comment_email'],$_POST['comment_content'],"UnApproved",$current_date]);

        $db->query('UPDATE posts set post_comment_count = post_comment_count +1 where id  = ? ',[$_POST['post_id']]);

        header('Location: ../post?id=' . $_POST['post_id']);
        exit();
    }
}

require base_path('post.php');

