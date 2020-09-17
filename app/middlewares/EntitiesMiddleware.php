<?php

namespace App\Middleware;

use Closure;
use Core\MiddlewareInterface;

class EntitiesMiddleware implements MiddlewareInterface
{

    public function handle($object, Closure $next)
    {
        foreach($_REQUEST as $clave => $input){

            $_REQUEST[$clave] = htmlentities($input);

        }

        return $next($object);  
         
    }
}
