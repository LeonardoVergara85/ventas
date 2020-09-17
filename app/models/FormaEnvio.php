<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class FormaEnvio extends Model
{

    public $_id;
    public $_descripcion;
    
    function __construct()
    { 

    }


    function obtenerFormasEnvioAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT id, descripcion FROM forma_envio_vw";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

}
