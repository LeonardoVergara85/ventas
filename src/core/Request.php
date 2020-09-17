<?php

namespace Core;

/**Provee una forma mas facil de acceder a los Request */
class Request
{
  /** Constructor de la clase
   * 
   * Pone todas las variables de $_SERVER y $_REQUEST como atributos de
   * la clase. Además añade la ruta del Request como atributo.
   */
  function __construct()
  {
    foreach ($_SERVER as $key => $value)
      $this->{toCamelCase($key)} = $value;

    foreach ($_REQUEST as $key => $value)
      $this->$key = $value;

    $this->route = isset($this->pathInfo) ? formatRoute($this->pathInfo) : '/';
  }
}
