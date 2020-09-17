<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class Familia extends Model
{

    public $_id;
    public $_descripcion;
    public $_porc_sugerido;
    
    function __construct()
    { 

    }


    function obtenerFamiliaAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM familia_producto";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

}