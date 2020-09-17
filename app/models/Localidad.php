<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class Localidad extends Model
{

    public $_id;
    
    function __construct()
    { 

    }


    function obtenerLocalidadesAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM localidades_vw order by descripcion asc";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

}
