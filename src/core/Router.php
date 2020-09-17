<?php

namespace Core;

class Router
{
  private $supportedHttpMethods = array("GET", "POST");
  private $routeMiddlewares = array();
  private $getDictionary = array();
  private $postDictionary = array();
  private $middlwareDictionary = array();

  /**
   * Constructor del Router
   * 
   * @param array $middlewares Los middlewares para las rutas
   * 
   * @return void
   */
  function __construct($middlewares =  array())
  {

    $this->supportedHttpMethods;
    $this->routeMiddlewares = $middlewares;
  }

  /**
   * @param Request $request
   * @return void
   */
  private function invalidMethodHandler($request)
  {
    header("{$request->serverProtocol} 405 Method Not Allowed");
  }

  /**
   * 
   */
  private function defaultRequestHandler($request)
  {
    header("{$request->serverProtocol} 404 Not Found");
  }

  /**
   * 
   */
  private function addMiddleware($route, $middlewares)
  {
    if (!is_array($middlewares))
      $middlewares = [$middlewares];

    foreach ($middlewares as $alias)
      $this->middlwareDictionary[$route][] = $this->routeMiddlewares[$alias];
  }

  /**
   * Agregar una nueva ruta GET 
   * 
   * @param string $route Ruta a registrar
   * @param mixed $method Acción asociada a la ruta
   * @param array $options Configuraciónes extra para la ruta
   * 
   * @return Router 
   */
  public function get($route, $method, $options = array())
  {
    $route = formatRoute($route);

    $this->getDictionary[$route] = $method;

    if (isset($options['middleware']))
      $this->addMiddleware($route, $options['middleware']);

    return $this;
  }

  /**
   * Agregar una nueva ruta POST
   * 
   * @param string $route Ruta a registrar
   * @param mixed $method Acción asociada a la ruta
   * @param array $options Configuraciónes extra para la ruta
   * 
   * @return Router 
   */
  public function post($route, $method, $options = array())
  {
    $route = formatRoute($route);
    $this->postDictionary[$route] = $method;

    if (isset($options['middleware']))
      $this->addMiddleware($route, $options['middleware']);

    return $this;
  }

  /**
   * 
   */
  public function resolve($request)
  {
    if ($request->requestMethod == 'POST')
      $methodDictionary = $this->postDictionary;
    else if ($request->requestMethod == 'GET')
      $methodDictionary = $this->getDictionary;
    else
      invalidMethodHandler($request);

    if (!array_key_exists($request->route, $methodDictionary)) {
      $this->defaultRequestHandler($request);
      return;
    }

    $method = $methodDictionary[$request->route];

    $middlewares = isset($this->middlwareDictionary[$request->route]) ? $this->middlwareDictionary[$request->route] : array();
    $middlewareManager = new \Core\MiddlewareManager();
    $middlewareManager->add($middlewares);


    $middlewareManager->run($request, function ($object) use ($method) {
      if (gettype($method) == 'object') {
        echo call_user_func_array($method, array());
        return;
      } else if (gettype($method) == 'string') {
        list($controller, $method) = explode('@', $method);
        $controller = "App\Controller\\" . $controller;
        $reflection = new \ReflectionMethod($controller, $method);
        $controller = new $controller;
        echo $reflection->invoke($controller);
        return;
      }
    });
  }
}
