<!-- Pager -->
<ul class="pager">
    <li class="previous">
        <a href="#">&larr; Older</a>
    </li>
    <li class="next">
        <a href="#">Newer &rarr;</a>
    </li>
</ul>

</div>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->

    <div class="well">

        <h4>Blog Search</h4>
        <form action="/lookup" method="post"> <!-- Submitting a POST Request through the form to get
        access of user entered data -->
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>

        </div>
        </form> <!-- closing form tag-->
        <!-- /.input-group -->
    </div>


    <!-- Log-in Form -->
    <?php if(!isset($_SESSION['user'])) :?>
    <div class="well">

        <h4>Log in</h4>
        <form action="/login" method="post"> <!-- Submitting a POST Request through the form to get
        access of user entered data -->
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>

            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit
                    </button>
                </span>
            </div>
        </form> <!-- closing form tag-->
        <!-- /.input-group -->
        <?php if(isset($_POST['login'])) :?>
            <b><p style="color: red;" class="text-xs mt-2"><?=$_SESSION['errors']?></b></p>
        <?php endif;?>
    </div>
    <?php endif;?>









    <!-- Blog Categories Well -->
    <div class="well">

       <?php
       // the $db is already declared in the index.php which this file(sidebar) is a partial of
       $cats = $db->query("SELECT p.*, c.cat_title AS category_name, p.post_user_id 
                    FROM posts AS p 
                    JOIN categories AS c ON p.post_category_id = c.id 
                    WHERE p.post_status = 'Publish';")->get();

       // we can use
       // the LIMIT operator to control how much/quantity of the result we want out of the DB
       ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
                    $user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';
                    $cat_ids = []; // create an empty array to store category IDs
                    foreach ($cats as $cat) {
                        // check if the current category ID has already been displayed
                        if (!in_array($cat['post_category_id'], $cat_ids) && $currentUserId == $cat['post_user_id'] && $user_role == 'subscriber') {
                            // if not, add the ID to the array and display the category
                            $cat_ids[] = $cat['post_category_id'];
                            ?>
                            <li><a href="<?php echo '/category?id=' . $cat['post_category_id'] ?>"><?php echo $cat['category_name'] ?></a></li>

                            <?php
                        }else {
                            if (!in_array($cat['post_category_id'], $cat_ids)) {
                                // if not, add the ID to the array and display the category
                                $cat_ids[] = $cat['post_category_id'];
                                ?>
                                <li><a href="<?php echo '/category?id=' . $cat['post_category_id'] ?>"><?php echo $cat['category_name'] ?></a></li>

                                <?php
                        }
                    }
                    }
                    ?>

                </ul>

            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>





    <!-- Side Widget Well -->
    <?= require 'widget.php'?>

</div>
