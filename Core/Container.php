<?php

namespace Core;

// This Class is a Service Container which is a common well established framework to bank('VAULT')
// all the NEEDED Services in one place

class Container

{
    protected $bindings = [];

    public function bind($key,$resolver) // binds the library 'key' to the user called function 'resolver'
    {
        $this->bindings[$key] = $resolver;

    }

    public function resolve($key) // executes the service library of the user called function
    {
            if (!array_key_exists($key,$this->bindings))
            {
                throw new \Exception('No matching binding found for '.$key);
            }

            return call_user_func($this->bindings[$key]);// returns the bound user called function associated
        // with the key in the bindings array
    }
}