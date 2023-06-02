<?php

namespace Core;

// API(Application Interface)
// use for the Service Container Class so it should contain the methods that it got to make it more user-friendly

class App
{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function getContainer()
    {
        return static::$container;
    }

    public static function bind($key,$resolver)
    {
        static::$container->bind($key,$resolver);
    }

    public static function resolve($key)
    {
        return static::$container->resolve($key);
    }

}