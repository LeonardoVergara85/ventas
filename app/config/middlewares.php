<?php

$globalMiddlewares = [
 
   // 'entities' => 'App\Middleware\EntitiesMiddleware',

];

$routeMiddlewares = [
    'auth' => 'App\Middleware\AuthMiddleware',
    'jwt' => 'App\Middleware\AuthJWTMiddleware',
];