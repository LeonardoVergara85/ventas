<?php

namespace App\Controller;

use Core\Controller;
use App\Model\Usuario;


class UsuarioController extends Controller
{
	private $Usuario;

	// constructor de la clase
	function __construct()
	{

        $this->Usuario = new Usuario();
		$this->request = new \Core\Request();

	}
    
	//	funciones del controlador

	public function listado(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

                $resultado->listado = $this->Usuario->listadoUsuarios();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los usuarios.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

    }
    
    public function obtenerCliente(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
				$this->Cliente->_id = $this->request->id_cliente;
                $resultado->listado = $this->Cliente->obtenerClienteId();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

    }
    
    public function listadoLocalidades(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Localidad = new Localidad();

		try {
                $resultado->listado = $this->Localidad->obtenerLocalidadesAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}


}