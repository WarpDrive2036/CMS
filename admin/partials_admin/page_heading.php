<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" style="margin-top: 100px;">
            Welcome <?=$_SESSION['user']['role'] == 'admin' ? 'Admin': 'Subscriber'?>
            <small><?=$_SESSION['user']['firstname'] .' '.$_SESSION['user']['lastname'] ?></small>

        </h1>
    </div>
</div>
<!--row -->
