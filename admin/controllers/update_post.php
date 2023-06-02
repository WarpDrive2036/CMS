<?php require_once base_path('Core/Database.php'); ?>

<?php
// bugs to fix: "date function gets an old date"
$_SESSION['id']= isset($_POST['post_id']) ? $_SESSION['id'] = $_POST['post_id'] : '';
$_SESSION['errors'] = [
    'post_title'=>'',
    'post_category_id'=>'',
    'post_author'=>'',
    'post_status'=>'',
    'post_image'=>'',
    'post_tags'=>'',
    'post_content'=>'',
];

$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

if (isset($_POST['edit_post'])) {
    // Check if the post_category_id value exists in the categories table
    $categoryId = $_POST['post_category_id'];
    $category = $db->query('SELECT * FROM categories WHERE id = ?', [$categoryId])->find();
    if (!$category) {
        $_SESSION['errors']['post_category_id'] = 'Invalid category id';
    }

    // Validate other form fields

    if (empty($_POST['post_category_id']) || trim($_POST['post_category_id']) === '') {
        $_SESSION['errors']['post_category_id'] = 'ID can not be empty! (Make sure the ID is already an added Category)';
    }
    if (empty($_POST['title']) || trim($_POST['title']) === '') {
        $_SESSION['errors']['post_title'] = 'Title can not be empty!';
    }
    if (empty($_POST['author']) || trim($_POST['author']) === '') {
        $_SESSION['errors']['post_author'] = 'Please enter the Author!';
    }
    if (empty($_POST['post_status']) || trim($_POST['post_status']) === '') {
        $_SESSION['errors']['post_status'] = 'Please enter the Status!';
    }
    if (empty($_FILES['image']['name'])) {
        $_SESSION['errors']['post_image'] = 'Please choose an image!';
    }
    if (empty($_POST['post_tags']) || trim($_POST['post_tags']) === '') {
        $_SESSION['errors']['post_tags'] = 'Please Enter the tags that relates with this post!';
    }
    if (empty($_POST['post_content']) || trim($_POST['post_content']) === '') {
        $_SESSION['errors']['post_content'] = 'Please enter the content of the blog!';
    }

    // Check for errors
    $errors = array_filter($_SESSION['errors']);
    if (!empty($errors))
    {
        // Display errors to user and prevent insert query from being executed
        require_once 'update_post.php';

    } else {
        // If there are no errors, insert the post record into the database
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_date = date('Y-m-d'); // Use a valid date format
        $post_comment_count = 0;
        $db->query('UPDATE posts SET post_category_id=?, post_title=?, post_author=?, post_date=?, post_image=?, post_content=?, post_tags=?, post_comment_count=?, post_status=? WHERE id=?', [
            $_POST['post_category_id'], $_POST['title'], $_POST['author'], $post_date, $post_image, $_POST['post_content'], $_POST['post_tags'], $post_comment_count, $_POST['post_status'], $_POST['post_id']
        ]);

        move_uploaded_file($post_image_temp, "images/$post_image");
//        header('location: /Admin_Posts');
//        exit();
    }
}


require_once base_path('admin/views/edit_post.view.php');

