<?php

namespace Core;

use League\Plates\Engine;

class View
{
  protected $template = null;
  protected $name = null;
  protected $data = null;

  function __construct($name, array $data = null)
  {
    $dir = str_replace('\\', '/', __DIR__);
    $path = str_replace('src/core', '', $dir) . "/app/views";
    $this->templates = new Engine($path);
    $this->name = $name;
    $this->data = $data;
  }

  function render()
  {
    if ($this->data != null)
      echo $this->templates->render($this->name, $this->data);
    else
      echo $this->templates->render($this->name);
  }
}
