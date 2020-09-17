<?php

namespace Core;

use \Closure;

interface MiddlewareInterface
{
    public function handle($object, Closure $next);
}
