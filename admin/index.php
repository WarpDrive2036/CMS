<!DOCTYPE html>
<html>
<head>
    <title>Your Page Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/css/bootstrap.min.css">
    <style>
        #wrapper {
            display: flex;
        }

        #sidebar {
            width: 200px;
            display: flex;
            flex-direction: column;
        }

        #page-wrapper {
            flex-grow: 1;
            padding-left: 0px;
        }

        #content {
            margin-top: 60px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="sidebar">
        <?php require base_path('admin/partials_admin/header.php')?>
        <?php require base_path('admin/partials_admin/nav.php')?>
    </div>
    <div id="page-wrapper">
        <div id="content">
            <div class="container-fluid">
                <!-- Your page content here -->
            </div>
            <div>
                <?php require base_path('admin/partials_admin/page_heading.php')?>
            </div>
        </div>


        <!-- /.row -->

        <!-- Admin Widgets -->
        <?php if($_SESSION['user']['role'] == 'admin') : ?>
        <div class="container" style="margin-left: -20px;">
        <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?=admin_dynamic_widgets('posts_all')?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="/Admin_Posts">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?=admin_dynamic_widgets('comments_all')?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="/Admin_comments">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?=admin_dynamic_widgets('users_all')?></div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="/Admin_users">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?=admin_dynamic_widgets('categories')?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="/Admin_Categories">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <!-- /.row -->
        </div>
    </div>
</div>

        <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php
                       $elements_text = ['Posts','Active Posts','Draft Posts','Comments','Pending Comments','Users','Subscribers','Categories'];

                       $elements_count = [
                           admin_dynamic_widgets('posts_all'),
                           admin_dynamic_widgets('posts','Publish'),
                           admin_dynamic_widgets('posts','draft'), // drafted posts (UnPublished Posts)
                           admin_dynamic_widgets('comments_all'),
                           admin_dynamic_widgets('comments','Unapproved'),
                           admin_dynamic_widgets('users_all'),
                           admin_dynamic_widgets('users','subscriber'),
                           admin_dynamic_widgets('categories')
                       ];


                       for ($i = 0; $i < count($elements_text); $i++)
                        {
                            echo "['{$elements_text[$i]}', {$elements_count[$i]}], ";
                            //the echoed statement needs to look or be displayed this ['Posts', 1000],
                        }
                        ?>
                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div id="columnchart_material" style="width: auto; height: 500px; margin-left: 40px;"></div>

        </div>
        <?php endif;?>

        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<div>
    <?php require base_path('admin/partials_admin/footer.php')?>
</div>
</body>
</html>
