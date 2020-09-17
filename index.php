<?php

//Carga el autoloader
$loader = require 'vendor/autoload.php';
    
include_once('src/core/GlobalHelper.php');

//Carga el .env
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load('.env');

//Inicia la sesión
$session = new \Core\Session();
$session->start();

//Manejo de Excepciones
set_exception_handler(function ($exception) {
    $error = new \stdClass;
    $error->message = $exception->getMessage();
    $error->code = $exception->getCode();
    $error->trace = $exception->getTraceAsString();

    $vista = new \Core\View('layout/error', ['error' => $error]);
    return $vista->render();
});
    
//Captura la Request
$request = new \Core\Request();

//Se registran los middlewares globales
$middlewareManager = new Core\MiddlewareManager();
include_once('app/config/middlewares.php');

$middlewareManager->add($globalMiddlewares);

//Crea el enrutador con los middlewares, incluye las rutas y resuelve
$router = new \Core\Router($routeMiddlewares);
include_once('app/config/routes.php');

$middlewareManager->run($request, function ($object) use ($router) {
    $router->resolve(new \Core\Request());
});
