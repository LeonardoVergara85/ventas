<?php

namespace Core;

if (strtolower($_ENV['APP_ENV']) == 'local') {

  include_once $_SERVER['DOCUMENT_ROOT'] . '\ventas\assets\libs\php\adodb\adodb.inc.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '\ventas\assets\libs\php\adodb\adodb-exceptions.inc.php';

} else {

  include_once $_SERVER['DOCUMENT_ROOT'] . '/ventas/assets/libs/php/adodb/adodb.inc.php';
  include_once $_SERVER['DOCUMENT_ROOT'] . '/ventas/assets/libs/php/adodb/adodb-exceptions.inc.php';

}

class Database
{
  private static $instance; // atributo estático para la base de datos
  public $db;

  // constructor de la función
  private function __construct()
  {
    // Está privada para que no se pueda instanciar
  }

  public static function DB()
  {
    if (is_null(static::$instance)) {
          
      static::$instance = new Database;
      static::$instance->db = NewADOConnection($_ENV['DB_MOTOR']);
      static::$instance->db->Connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
      static::$instance->db->SetFetchMode(ADODB_FETCH_ASSOC);

      $sql = "SET NAMES 'utf8'";
      static::$instance->db->Execute($sql);
    }

    //Guarda el usuario para la auditoría
    // if (session()->exists('logueado')) {
    //   $sql = static::$instance->db->Prepare("BEGIN DBMS_SESSION.SET_IDENTIFIER(:usuario); END;");
    //   static::$instance->db->InParameter($sql, session()->get('usuario'), 'usuario');
    //   static::$instance->db->Execute($sql);
    // }

    if ( !isset($_SESSION) ) {
      session_start();
  }

    // retornamos la conexion de la base para poder ser instanciada
    return  static::$instance->db;

  }


  final public function __clone()
  {
    throw new Exception('Deshabilitado.');
  }

  final public function __wakeup()
  {
    throw new Exception('Deshabilitado.');
  }
}
