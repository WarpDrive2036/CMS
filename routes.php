<?php

//return [
//    '/' => 'controllers/index.php',
//    '/about' => 'controllers/about.php',
//    '/contact' => 'controllers/contact.php',
//    '/note' => 'controllers/notes/show.php',
//    '/notes/create'=> `'controllers/notes/create.php',
//    '/notes' => 'controllers/notes/index.php'
//];

// This Refactor/Update to our Router made it possible to accept diverse custom requests from both users/page


$router->get('/','index.php');
$router->post('/login','controllers/login.php');

$router->get('/admin','admin/index.php')->only('guest');
$router->get('/subscriber','admin/index.php')->only('guest');
$router->get('/category', 'category.php');

$router->get('/post','post.php');
$router->post('/post','post.php');
$router->delete('/post','admin/controllers/delete_post.php');

$router->get("/Admin_Categories",'admin/controllers/categories.php')->only('guest');
$router->post('/Category','admin/controllers/add_cat.php')->only('guest');
$router->patch('/Category','admin/controllers/update.php')->only('guest');
$router->delete('/Category','admin/controllers/delete_cat.php')->only('guest');


$router->patch('/post','admin/controllers/update_post.php');
$router->post('/comments',"controllers/add_comments.php");


$router->get('/Admin_comments','admin/controllers/comments.php')->only('auth');
$router->post('/comment/authorize',"admin/controllers/comment_concession.php")->only('auth');;
$router->delete('/comment/delete',"admin/controllers/delete_comments.php")->only('auth');;

$router->get('/Admin_users','admin/controllers/users.php')->only('auth');;
$router->get('/Admin_users-add','admin/controllers/add_users.php')->only('auth');;
$router->post('/Admin_users-add','admin/controllers/add_users.php')->only('auth');;
$router->delete('/User/delete','admin/controllers/delete_user.php')->only('auth');;
$router->patch('/User_update','admin/controllers/update_credentials.php')->only('auth');;


$router->post('/lookup','search.php');

$router->get('/logout','controllers/logout.php')->only('guest');

$router->get('/Admin_Posts','admin/controllers/posts.php')->only('guest');
$router->get('/Admin_Posts-create','admin/views/add_posts.view.php')->only('guest');
$router->post('/Add_post','admin/controllers/add_posts.php')->only('guest');

$router->get('/profile','admin/controllers/profile.php')->only('guest');
$router->patch('/Profile_edit','admin/controllers/profile.php')->only('guest');

$router->get('/Sign_Up','controllers/sign_up.php');
$router->post('/Sign_Up','controllers/sign_up.php');









