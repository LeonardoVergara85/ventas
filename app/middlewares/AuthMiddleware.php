<?php

namespace App\Middleware;

use Closure;
use Core\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{

    public function handle($object, Closure $next)
    {
        if (!session()->exists('logueado')){

            return redirect('/login');

        }else{
            
            return redirect('/home');

        }
            
    }
}
