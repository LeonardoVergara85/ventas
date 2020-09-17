<?php

namespace Core;

class Controller
{
  /**Almacena el Request para poder acceder más facilmente a los datos de GET y POST */
  protected $request = null;

  function __construct()
  {
      $this->request = new Request;
  }
}