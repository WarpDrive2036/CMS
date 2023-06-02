<?php include('partials/header.php');?>
<?php

$config = require 'config.php';
$db = new \Core\Database($config['database']);
$currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
$user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';
?>
<?php include('partials/nav.php'); ?>


<!-- Page Content -->
<div class="container">

    <div class="row">


        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if(isset($_POST['submit']) && $user_role == 'subscriber')
            {
                // NOTE:we are querying the post_tags with the "LIKE" operator (Finds any values, entered by the user in any position.)
                $result = ($db->query('select * from posts where post_tags LIKE ? AND post_status = "Publish" AND post_user_id = ?',["%".strtoupper($_POST['search'])."%",$currentUserId]))->get();;

                if(!$result) // we check if the query/search of the blog post_title is in the DB or not
                {
                    echo "<h1>no results Found</h1>";
                }
                else{
                    foreach ($result as $value):
                        ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="<?="/post?id=".$value['id'] ?>"><?=$value['post_title']?></a>
                        </h2>
                        <p class="lead">
                            by <a href="/"><?=$value['post_author']?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$value['post_date']?></p>
                        <hr>

                        <!-- Dynamically checks if the image is from an external source or locally
                         stored in the images folder -->
                        <a href="<?='/post?id=' . $value['id'] ?>">
                        <img class="img-responsive" src="<?= file_exists('images/'. $value['post_image']) ? 'images/' . $value['post_image'] : $value['post_image'] ?>">
                    </a>

                        <hr>
                        <p><?= substr($value['post_content'], 0, 550) ?>...</p>
                        <a class="btn btn-primary" href="<?='/post?id='.$value['id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php
                    endforeach;
                }
            }else {
                // NOTE:we are querying the post_tags with the "LIKE" operator (Finds any values, entered by the user in any position.)
                $result = ($db->query('select * from posts where post_tags LIKE ? AND post_status = "Publish"',["%".strtoupper($_POST['search'])."%"]))->get();;

                if(!$result) // we check if the query/search of the blog post_title is in the DB or not
                {
                    echo "<h1>no results Found</h1>";
                }
                else{
                    foreach ($result as $value):
                        ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                        <a href="<?="/post?id=".$value['id'] ?>"><?=htmlspecialchars($value['post_title'])?></a>
                        </h2>
                        <p class="lead">
                            by <a href="/"><?=$value['post_author']?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$value['post_date']?></p>
                        <hr>

                        <!-- Dynamically checks if the image is from an external source or locally
                         stored in the images folder -->
                        <a href="<?='/post?id=' . $value['id'] ?>">
                            <img class="img-responsive" src="<?= file_exists('images/'. $value['post_image']) ? 'images/' . $value['post_image'] : $value['post_image'] ?>">
                        </a>

                        <hr>
                        <p><?= substr($value['post_content'], 0, 550) ?>...</p>
                        <a class="btn btn-primary" href="<?='post?id='. $value['id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php
                    endforeach;
                }
            }//checks if a post request was requested using the button inside the form
            ?>



            <?php include('partials/sidebar.php');?>

        </div>

        <!-- /.row -->

        <hr>

        <?php include('partials/footer.php');?>
