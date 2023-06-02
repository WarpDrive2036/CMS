<?php

use Core\Response;


// Saves time so we wont need to always explicitly add the BASE_PATH const
function base_path($path){

    return BASE_PATH . $path;
}
function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}


function abort($code = 404)
{
    http_response_code($code);

    require base_path("admin/views/{$code}.php");

    die();

}

function admin_dynamic_widgets($table, $where = '')
{
    $config = require base_path('config.php');
    $db = new \Core\Database($config['database']);

    switch ($table) {
        case 'posts';
            $result = $db->query('SELECT COUNT(*) AS total FROM posts where post_status = ?',[$where])->get();
           return $result[0]['total'];

        case 'posts_all';
            $result = $db->query('SELECT COUNT(*) AS total FROM posts')->get();
            return $result[0]['total'];

           case 'users';
                $result = $db->query('SELECT COUNT(*) AS total FROM users where role = ?',[$where])->get();
               return $result[0]['total'];

        case 'users_all';
            $result = $db->query('SELECT COUNT(*) AS total FROM users')->get();
            return $result[0]['total'];

        case 'categories';
            $result = $db->query('SELECT COUNT(*) AS total FROM categories')->get();
            return $result[0]['total'];

        case 'comments_all';
            $result = $db->query('SELECT COUNT(*) AS total FROM comments')->get();
            return $result[0]['total'];

        case 'comments';
            $result = $db->query('SELECT COUNT(*) AS total FROM comments where comment_status = ?',[$where])->get();
            return $result[0]['total'];
    }
    exit();
}


//Default Status will be 403 (Forbidden)
function authorize($condition, $status = Response::FORBIDDEN){

    if (!$condition){
        abort($status); //Created a custom Response class to eliminate a "Magic number" or
        // the need to search for the meaning behind status code number
    }
}

//lets create a function that creates a session each time a user is logged in
function login($user)
{
    $_SESSION['user']= [
        'email'=>$user['email'] //storing the user's email in the session
    ];
    session_regenerate_id(true); //for security reasons
}

function logout()
{
    $_SESSION = []; //Empty the Session Super Global

    session_destroy();// destroy the session file saved in the TMPR DIR folder in the server

    $params= session_get_cookie_params();
//finally delete the cookies
    setcookie('PHPSESSID','',time() - 3600,$params['path'],$params['domain'],$params['secure'],$params['httponly']);

}




// API DEV Friendly function to include/require views
function view($path,$attributes=[]){

    extract($attributes);// basically converts an associative array's key name into a variable &
    // its value into the value of the newly converted variable

    return require base_path('views/'.$path);
}

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}