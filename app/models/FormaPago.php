<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class FormaPago extends Model
{

    public $_id;
    public $_descripcion;
    
    function __construct()
    { 

    }


    function obtenerFormasPagoAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM tipos_pagos_vw";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

}
