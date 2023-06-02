<?php include base_path('partials/header.php');?>

<?php
$config = require base_path('config.php');
$db = new \Core\Database($config['database']);

$postsByCategories = $db->query("SELECT c.id AS category_id, GROUP_CONCAT(DISTINCT p.id ORDER BY p.id) AS post_ids
    FROM categories AS c
    JOIN posts AS p ON p.post_category_id = c.id
    GROUP BY c.id;")->get();

$posts = $db->query("select * from posts where post_status = 'Publish'")->get();
?>

<?php include base_path('partials/nav.php');?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            // Get the category ID from the URL
            $category_id = $_GET['id']; ?>

<!--  Loop through the categories and find the one that matches the ID-->
             <?php foreach ($postsByCategories as $postsByCategory) :?>

                     <?php if ($postsByCategory['category_id'] == $category_id) : ?>
            <!-- Get the array of post IDs for the current category -->
                          <?php $post_ids = explode(',', $postsByCategory['post_ids']); ?>

            <!-- Loop through the posts and display only the ones with IDs in the $post_ids array -->
                                   <?php  foreach ($posts as $post) :?>

                         <?php if (in_array($post['id'], $post_ids)) : ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="<?="/post?id=" . $post['id'] ?>"><?=htmlspecialchars($post['post_title']) ?></a>

                        </h2>
                        <p class="lead">
                            by <a href="/"><?=htmlspecialchars($post['post_author'])?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post['post_date']?></p>
                        <hr>

                        <!-- Dynamically checks if the image is from an external source or locally
                         stored in the images folder -->
                        <a href="<?='/post?id=' . $post['id'] ?>">
                            <img class="img-responsive" src="<?= file_exists('images/'. $post['post_image']) ? 'images/' . $post['post_image'] : $post['post_image'] ?>">
                        </a>

                        <hr>
                        <!-- The substr() function takes three arguments:

                        the string to be truncated ($post['post_content'] in this case)
                        the starting position of the substring (0 in this case, to start from the beginning of the string)
                        the length of the substring (100 in this case, to display the first 100 characters)
                        The ... at the end is just to indicate that the text has been truncated and is optional. -->

                        <p><?= substr(($post['post_content']), 0, 550) ?>...</p>

                        <a class="btn btn-primary" href="<?='post?id='. $post['id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>

            <?php endif;?>
            <?php endforeach; ?>
            <?php endif;?>
             <?php endforeach; ?>






           <?php include base_path('partials/sidebar.php');?>


        </div>

        <!-- /.row -->

        <hr>

        <?php include base_path('partials/footer.php');?>
