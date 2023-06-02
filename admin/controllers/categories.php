<?php require_once base_path('Core/Database.php') ?>

<?php $config = require base_path('config.php');

$db = new \Core\Database($config['database']);
$cat_titles = $db->query('SELECT * FROM categories')->get();


require base_path('admin/views/categories.view.php');

