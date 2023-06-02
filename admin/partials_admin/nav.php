<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$_SESSION['user']['role']=='admin' ? '/admin': '/subscriber'?>">CMS <?=$_SESSION['user']['role'] == 'admin' ? 'Admin': 'Subscriber'?></a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="/">Home Page</a></li>


<!--            <li class="dropdown">-->
<!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>-->
<!--                <ul class="dropdown-menu alert-dropdown">-->
<!--                    <li>-->
<!--                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>-->
<!--                    </li>-->
<!--                    <li class="divider"></li>-->
<!--                    <li>-->
<!--                        <a href="#">View All</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['user']['firstname'] .' '. $_SESSION['user']['lastname'] ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">

                    <li>
                        <a href="/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href=<?=$_SESSION['user']['role']=='admin' ? '/admin': '/subscriber'?>><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="posts_dropdown" class="collapse">
                        <li>
                            <a href="/Admin_Posts">View all Posts</a>
                        </li>
                        <li>
                            <a href="/Admin_Posts-create">Add Posts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/Admin_Categories"><i class="fa fa-fw fa-wrench"></i>Categories</a>
                </li>


                <?php if($_SESSION['user']['role'] =='admin') :?>
                <li class="active">
                    <a href="/Admin_comments"><i class="fa fa-fw fa-file"></i>Comments</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="users_dropdown" class="collapse">
                        <li>
                            <a href="/Admin_users">View All Users</a>
                        </li>
                        <li>
                            <a href="/Admin_users-add">Add Users</a>
                        </li>
                    </ul>
                </li>
                <?php endif;?>
                <li>
                    <a href="/profile"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>