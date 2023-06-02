<?php

namespace Core\Middleware;

class Middleware
{
    // A Constant that basically maps the middleware terms to their respective "Handling Classes"
    public const MAP = [
        'auth'=>Auth::class,
        'guest'=>Guest::class
    ];

    public static function resolve($key)
    {
        if(!$key) //returns this function again explicitly as middlewares are set by default to null
        {
            return;
        }

        $middleware = Middleware::MAP[$key] ?? false;//Find the middleware value of the current route
        // + if there isnt a key found in the MAP return false

        if (!$middleware) //if we come here then no middleware in the MAP & thus its un-valid middleware
        {
            throw new \Exception('No matching middleware for key '. $key. '.');
        }

        //if all is good then we can handle the middleware
        (new $middleware)->handle(); // call the respective handling Class

    }
}
