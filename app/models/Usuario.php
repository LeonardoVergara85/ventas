<?php

namespace App\Model;

use Core\Model;
use Core\Database;

class Usuario extends Model
{
 public $_username;
 public $_password;

    function __construct()
    { }


    function obtenerUsuario()
    {
        $user = $this->_username;
        //$pass = $this->_password;

        $conexion = Database::DB();
        
        $sql = "SELECT id,username,nombre,apellido,tipo,pass FROM usuarios_vw WHERE USERNAME = ?";
        
        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($user));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }


    function listadoUsuarios()
    {

        $conexion = Database::DB();
        
        $sql = "SELECT username,nombre,dni,apellido,tipo FROM usuarios_vw ";
        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }


}
