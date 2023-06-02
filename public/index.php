<?php


// NOTE: Anything saved in a Session is saved temporarily (Cookies one in the browser & one from the server)
session_start(); // Starting/Declaring a Session on the "public root folder" to instantly instantiate
// when the folder and this file loads

const BASE_PATH = __DIR__ .'/../'; // basically returns the root folder path on the computer

require BASE_PATH . 'Core/functions.php';

// Below Method Basically Listens to ALL Classes when "Instantiated" & implicitly/auto requires them
spl_autoload_register(function ($class){
    $class = str_replace('\\',DIRECTORY_SEPARATOR,$class); // replaces the \ embedded by the
    // name-space with / to be able to require & autoload it.

    require base_path("{$class}.php");
});
require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('routes.php');

$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD']; //checks hidden variable
// "_method" type when a POST Request is detected

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//routeToController($uri, $routes); instead of this method to route a URI we gonna implement a new method in
// the instantiated $routes object above
$router->route($uri,$method);











//$id = $_GET['id'];

//Now we are testing the idea of SQL Injection(User entering a malicious query into our database because
// he/she were accidentally allowed to)

//$posts = $db->query("select * from posts where id= $id")->fetch();  //DON"T DO THIS!!!!

//$query = "select * from users where id= ?"; // We are going to bind "?" to from a separate bound parameter so
// it doesn't affect the original Sql query

//dd($query);

//$posts = $db->query($query,[$id])->fetch();

//dd($posts);


//_GET SuperGlobal variable listens & returns user made queries in the "browser address bar"

//Let's dd(dump & die) to test it alone

//dd($_GET);



//foreach ($posts as $post){
//    echo "<li>".$post['title']."</li>";
//}














