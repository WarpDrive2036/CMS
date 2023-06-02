<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CMS Front</a>
        </div>

        <!-- Just Styling so the Edit Post is displayed next to the other links in the Nav -->
        <style>
            .navbar-nav > .edit-post {
                display: inline-block;
                vertical-align: top;
            }

            .navbar-nav > .edit-post > a {
                padding: 15px;
            }
        </style>

        <?php
        $currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
        $user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';

        $config = require base_path('config.php');
        $db = new \Core\Database($config['database']);

        $user_post = $db->query('SELECT * from posts where post_user_id = ?',[$currentUserId])->get();

        $admin_post = $db->query('SELECT * from posts')->get();

        ?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                $cat_titles = $db->query("SELECT p.*, c.cat_title AS category_name, p.post_user_id 
                    FROM posts AS p 
                    JOIN categories AS c ON p.post_category_id = c.id 
                    WHERE p.post_status = 'Publish';")->get();

                $cat_ids = []; // create an empty array to store category IDs

                $currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['user_id'] : '';
                $user_role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : '';

                foreach ($cat_titles as $cat) {
                    // check if the current category ID has already been displayed
                    if (!in_array($cat['post_category_id'], $cat_ids) && $currentUserId == $cat['post_user_id'] && $user_role == 'subscriber') {
                        // if not, add the ID to the array and display the category
                        $cat_ids[] = $cat['post_category_id'];
                        ?>
                        <li><a href="/category?id=<?=$cat['post_category_id']?>"><?=$cat['category_name']?></a></li>
                        <?php
                    }else {
                        if (!in_array($cat['post_category_id'], $cat_ids)) {
                            // if not, add the ID to the array and display the category
                            $cat_ids[] = $cat['post_category_id'];
                            ?>
                            <li><a href="/category?id=<?=$cat['post_category_id']?>"><?=$cat['category_name']?></a></li>
                            <?php
                        }
                    }
                }
                ?>
                <li>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') :?>
                    <a href="/admin">Admin Dashboard</a>
                    <?php endif;?>

                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'subscriber') :?>
                        <a href="/subscriber">Dashboard</a>
                    <?php endif;?>

                    <?php if (!isset($_SESSION['user'])):?>
                        <a href="/Sign_Up">Sign Up</a>
                    <?php endif;?>
                </li>

                <li class="edit-post" style="margin-top: 10px;">
                    <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'subscriber' && isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/post') : ?>
                        <form style="display: inline-block;" action="/post" method="post">
                            <input type="hidden" name="_method" value="PATCH">
                            <?php foreach ($user_post as $post): ?>
                                <?php if (isset($_GET['id']) && $post['id'] == $_GET['id']): ?>
                                    <button class="edit-btn" type="submit">Edit Post</button>
                                    <input type="hidden" name="post_id" value="<?=$post['id']?>">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </form>
                    <?php endif; ?>
                </li>


                <li class="edit-post" style="margin-top: 10px;">
                    <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'admin' && isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] == '/post') : ?>
                        <form style="display: inline-block;" action="/post" method="post">
                            <input type="hidden" name="_method" value="PATCH">
                            <?php foreach ($admin_post as $post): ?>
                                <?php if (isset($_GET['id']) && $post['id'] == $_GET['id']): ?>
                                    <button class="edit-btn" type="submit">Edit Post</button>
                                    <input type="hidden" name="post_id" value="<?=$post['id']?>">
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </form>
                    <?php endif; ?>
                </li>









                <!--                <li>-->
<!--                    <a href="/includes/db.php">Services</a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">Contact</a>-->
<!--                </li>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>