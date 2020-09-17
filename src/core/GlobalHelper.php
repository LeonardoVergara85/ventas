<?php

use Core\Session;

/**Constante del path de la aplicación */
define('HOME_PATH', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

/**Realiza una redirección a la ruta que se le pasa por parámetro */
function redirect($url, $statusCode = 303)
{
  $url = ltrim($url, '/');
  header('Location: ' . HOME_PATH . $url, true, $statusCode);
  die();
}

/**Retorna la ruta completa hacia un recurso */
function asset($url)
{
  $url = ltrim($url, '/');
  return HOME_PATH . 'assets/' . $url;
}

/**Retorna la ruta completa hacia una librería en el repositorio */
function lib($url)
{
  $url = ltrim($url, '/');
  return '/ventas/assets/' . $url;
}

/**Retorna una instancia de la sesión */
function session()
{
  return new \Core\Session();
}

/**Pasa el String que recibe como parámetro a Camel Case */
//Funciones internas
function toCamelCase($string)
{
  $result = strtolower($string);

  preg_match_all('/_[a-z]/', $result, $matches);

  foreach ($matches[0] as $match) {
    $c = str_replace('_', '', strtoupper($match));
    $result = str_replace($match, $c, $result);
  }

  return $result;
}

/**Quita las barras de la derecha de la ruta */
function formatRoute($route)
{
  $result = rtrim($route, '/');

  if ($result === '') {
    return '/';
  }

  return $result;
}

function encrypt($data, $key)
{
  $encryption_key = base64_decode($key);
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
  return base64_encode($encrypted . '::' . $iv);
}

function decrypt($data, $key)
{
  $encryption_key = base64_decode($key);
  list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
  return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function url($route) {
  return HOME_PATH.ltrim($route, '/');
}