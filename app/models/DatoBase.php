<?php

namespace App\Model;

use Core\Model;
use Core\Database;

class DatoBase extends Model
{
	private $tabla;

	function __construct($tabla)
	{ 
		$this->tabla = $tabla;
	}

	function listado($soloActivos = false)
	{
		$conexion = Database::DB();

		$soloActivos = $soloActivos ? "WHERE ACTIVO = 'S'" : '';
		$sql = "SELECT ID, DESCRIPCION, ACTIVO FROM $this->tabla $soloActivos ORDER BY DESCRIPCION DESC";
		$consulta = $conexion->Execute($sql);

		$resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		return $resultado;
	}

	function alta($descripcion, $activo)
	{
		$conexion = Database::DB();
		$sql = "INSERT INTO $this->tabla (DESCRIPCION, ACTIVO) VALUES (:descripcion, :activo)";
		$consulta = $conexion->Prepare($sql);
		$conexion->InParameter($consulta, $descripcion, 'descripcion');
		$conexion->InParameter($consulta, $activo, 'activo');
		$resultado = $conexion->Execute($consulta);
		return $resultado;
	}

	function baja($id)
	{
		$conexion = Database::DB();

		$sql = "DELETE FROM $this->tabla WHERE ID = :id";
		$consulta = $conexion->Prepare($sql);
		$conexion->InParameter($consulta, $id, 'id');
		$resultado = $conexion->Execute($consulta);
	}

	function modificar($id, $descripcion, $activo)
	{
		$conexion = Database::DB();
		
		$descripcion = $descripcion;
		$sql = "UPDATE $this->tabla SET DESCRIPCION = :descripcion, ACTIVO = :activo WHERE ID = :id";
		$consulta = $conexion->Prepare($sql);
		$conexion->InParameter($consulta, $descripcion, 'descripcion');
		$conexion->InParameter($consulta, $activo, 'activo');
		$conexion->InParameter($consulta, $id, 'id');
		$resultado = $conexion->Execute($consulta);
		return $resultado;
	}

	function existeDescripcion($descripcion)
	{
		$conexion = Database::DB();
		
		$descripcion = $descripcion;
		$sql = "SELECT DESCRIPCION FROM $this->tabla WHERE UPPER(DESCRIPCION) = UPPER(:descripcion)";
		$consulta = $conexion->Prepare($sql);
		$conexion->InParameter($consulta, $descripcion, 'descripcion');
		$consulta = $conexion->Execute($consulta);
		while ($r = $consulta->fetchRow())
			return true;
		return false;
	}

	function existeRegistroDistinto($id, $descripcion)
	{
		$conexion = Database::DB();
		
		$descripcion = $descripcion;
		$sql = "SELECT DESCRIPCION FROM $this->tabla WHERE ID != :id AND UPPER(DESCRIPCION) = UPPER(:descripcion)";
		$consulta = $conexion->Prepare($sql);
		$conexion->InParameter($consulta, $id, 'id');
		$conexion->InParameter($consulta, $descripcion, 'descripcion');
		$consulta = $conexion->Execute($consulta);
		while ($r = $consulta->fetchRow())
			return true;
		return false;
	}

	function existeRegistroID($id)
	{
		$conexion = Database::DB();
		
		$sql = "SELECT ID FROM $this->tabla WHERE ID = :id";
		$consulta = $conexion->Prepare($sql);
		$conexion->InParameter($consulta, $id, 'id');
		$consulta = $conexion->Execute($consulta);
		while ($r = $consulta->fetchRow())
			return true;
		return false;
	}
}
