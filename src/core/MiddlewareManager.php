<?php

namespace Core;

use InvalidArgumentException;
use Closure;

/**Se encarga de registrar y ejecutar Middlewares */
class MiddlewareManager
{
    /**Listado de Middlewares */
    private $middlewares = [];

    /**Instancia la clase con un array de Middlewares */
    public function __construct(array $middlewares = [])
    {
        $this->middlewares = $middlewares;
    }
    
    /**Permite agregar N Middlewares a la lista */
    public function add($middlewares)
    {
        foreach($middlewares as $middleware)
            $this->middlewares[] = new $middleware();
    }

    /**Ejecuta todos lo Middlewares registrados sobre un objeto y una función que recibe como parámetro */
    public function run($object, Closure $target)
    {
        $targetFunction = function($object) use($target) {
            return $target($object);
        };
        
        $middlewares = array_reverse($this->middlewares);

        $complete = array_reduce($middlewares, function ($nextMiddleware, $middleware) {
            return function ($object) use ($nextMiddleware, $middleware) {
                return $middleware->handle($object, $nextMiddleware);
            };
        }, $targetFunction);

        return $complete($object);
    }
}
