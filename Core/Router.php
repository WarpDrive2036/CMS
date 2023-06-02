<?php

namespace Core;
use Core\Middleware\Middleware;

class Router {

    protected $routes = [];

    public function add($method,$uri,$controller)
    {
        $this->routes[]= [
            'uri'=>$uri,
            'controller'=>$controller,
            'method'=>$method,
            'middleware'=>null // is a bridge/Border control between the core of the app & the
            // user.....(middleware gains its value when a particular route is assigned one )

        ];

        return $this;
    }
    public function get($uri,$controller) // DEFAULT: requests the uri with Request page method of _GET
    {
      return $this->add('GET',$uri,$controller);
    }

    public function put($uri,$controller)
    {
        return $this->add('PUT',$uri,$controller);
    }

    public function post($uri,$controller)
    {
        return $this->add('POST',$uri,$controller);
    }

    public function patch($uri,$controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }
    public function delete($uri,$controller) // Custom-made Request Method to Delete Forms in an indirect way
    {
        return $this->add('DELETE',$uri,$controller);
    }

    // this method adds the key value to the middleware key found in the routes array we do this by getting
    // the last called element of the routes array & adding the middleware value
    public function only($key)
    {
       $this->routes[array_key_last($this->routes)]['middleware'] = $key;

       return $this;// we are returning the whole Class(with its methods etc..) so we can chain further into it
        // when needed
    }

    public function route($uri,$method)
    {
        foreach ($this->routes as $route) {
            //checking the uri & page request method if they are stored in the routes array or not
            if($route['uri']=== $uri && $route['method'] === strtoupper($method))
            {
                //applying the new middleware features after REFACTORING
                Middleware::resolve($route['middleware']);


              //The below code is before refactoring

                //We check first as middlewares are set to null by default
                   //if(route['middleware'])


//                  $middleware= Middleware::MAP[$route['middleware']];//Picks the needed middleware from the MAP
//                    // depending on the current route middleware value & returns the handling class
//
//                    (new $middleware)->handle(); // Depending on the handling Class mapped we instantiate then call
//                    // the "handle" function

                return require base_path($route['controller']);
            }
        } // abort

            $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("admin/views/{$code}.php");

        die();

    }
}






//
//$routes = require base_path('routes.php');
//function routeToController($uri, $routes) {
//    if (array_key_exists($uri, $routes)) {
//        require base_path($routes[$uri]);
//    } else {
//        abort();
//    }
//}
//
//function abort($code = 404) {
//    http_response_code($code);
//
//    require base_path("views/{$code}.php");
//
//    die();
//}
//
//$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
//
//routeToController($uri, $routes);