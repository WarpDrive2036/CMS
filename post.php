<?php include base_path('partials/header.php');?>

<?php
    $config = require base_path('config.php');
    $db = new \Core\Database($config['database']);

    $posts = $db->query("select * from posts where post_status = 'Publish'")->get();

    // the $db is already declared in the index.php which this file(sidebar) is a partial of
    $cats = ($db->query('select * from categories'))->get(); // we can use
    // the LIMIT operator to control how much/quantity of the result we want out of the DB

    $comments_approved = $db->query('SELECT * FROM comments WHERE comment_post_id = ? AND comment_status = ?', [$_GET['id'], 'Approved'])->get();

    ?>

<?php include base_path('partials/nav.php');?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <?php foreach ($posts as $post): ?>

                <?php if ($post['id'] == $_GET['id']): ?>

                <!-- Title -->
                <h1><?=htmlspecialchars($post['post_title'])?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?=htmlspecialchars($post['post_author'])?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post['post_date']?></p>

                <hr>

                <!-- Preview Image -->
                <!-- Dynamically checks if the image is from an external source or locally
                      stored in the images folder -->
                <img class="img-responsive" src="<?= file_exists('images/'. $post['post_image']) ? 'images/' . $post['post_image'] : $post['post_image'] ?>">

                <hr>

                <!-- Post Content -->
                <p><?=($post['post_content'])?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    <form role="form" action="/comments" method="post">

                        <label for="Author">Author</label>
                        <div class="form-group">
                           <input type="text" class="form-control" name="comment_author">
                        </div>
<!--                        --><?php //=isset($_SESSION['errors'])? $_SESSION['errors']['comment_author'] : ''; ?>

                        <label for="Email">Email</label>
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <label for="Comment">Your Comment</label>
                        <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                            <input type="hidden" class="form-control" name="post_id" value="<?=$post['id']?>">
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <!-- Comment -->
                <?php foreach ($comments_approved as $comment_approved) :?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?=htmlspecialchars($comment_approved['comment_author'])?>
                            <small><?=$comment_approved['comment_date']?></small>
                        </h4>
                        <p><?=htmlspecialchars($comment_approved['comment_content'])?></p>


                </div>
                    <?php endforeach;?>


                    <!-- End Nested Comment -->
                    </div>
                </div>

            <?php endif;?>
            <?php endforeach;?>


            <!-- /.row -->


            <?php
            include base_path('partials/sidebar.php');?>
<hr>


<?php include base_path('partials/footer.php');?>







