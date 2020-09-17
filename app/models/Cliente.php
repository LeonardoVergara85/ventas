<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class Cliente extends Model
{

    public $_id;
    public $_id_persona;
    public $_nombre;
    public $_apellido;
    public $_dni;
    public $_fecha_nac;
    public $_nro_cliente;
    public $_domicilio;
    public $_localidad;
    public $_telefono;
    public $_correo;
    
    function __construct()
    { 

    }

    function guardar()
    {
        $_nombre = $this->_nombre;
        $_apellido = $this->_apellido;
        $_dni = $this->_dni;
        $_fecha_nac = $this->_fecha_nac;
        $_nro_cliente = $this->_nro_cliente;
        $_localidad = $this->_localidad;
        $_domicilio = $this->_domicilio;
        $_telefono = $this->_telefono;
        $_correo = $this->_correo;

        $conexion = Database::DB();
        
        $conexion->startTrans();

        $sql = "CALL cliente_alta_p(?,?,?,?,?,?,?,?,?)";


        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($_nombre,$_apellido,$_dni,$_fecha_nac,$_domicilio,$_nro_cliente,$_localidad,$_correo,$_telefono));


        $conexion->completeTrans();

		return $consulta;
    }

    function modificar()
    {
        $_id = $this->_id;
        $_nombre = $this->_nombre;
        $_apellido = $this->_apellido;
        $_dni = $this->_dni;
        $_fecha_nac = $this->_fecha_nac;
        $_nro_cliente = $this->_nro_cliente;
        $_localidad = $this->_localidad;
        $_domicilio = $this->_domicilio;
        $_telefono = $this->_telefono;
        $_correo = $this->_correo;

        $conexion = Database::DB();

        $sql = "CALL modificar_cliente_p(?,?,?,?,?,?,?,?,?,?)";

        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($_id,$_nombre,$_apellido,$_dni,$_fecha_nac,$_nro_cliente,$_localidad,$_domicilio,$_correo,$_telefono));

		return $consulta;
    }


    function obtenerClientesAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM clientes_vw";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerClienteId()
    {
        $id = $this->_id;

        $conexion = Database::DB();

        $sql = "SELECT *
                FROM clientes_vw
                WHERE id = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($id));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerClienteNro()
    {
        $nro = $this->_nro_cliente;

        $conexion = Database::DB();

        $sql = "SELECT COUNT(*) AS cant
                FROM clientes_vw
                WHERE nro_cliente = ?";

       $consulta = $conexion->Prepare($sql);

       $consulta = $conexion->Execute($consulta,array($nro));
        
     return $consulta;
     
   }
}
