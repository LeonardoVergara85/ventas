<?php

namespace App\Controller;

use Core\Controller;
use App\Model\Cliente;
use App\Model\Localidad;


class ClienteController extends Controller
{
	private $Cliente;
	private $Localidad;

	// constructor de la clase
	function __construct()
	{

        $this->Cliente = new Cliente();
		$this->request = new \Core\Request();

	}
    
	//	funciones del controlador
	
	public function guardar(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

			$this->Cliente->_nombre = $this->request->nom;
			$this->Cliente->_apellido = $this->request->ape;
			$this->Cliente->_dni = $this->request->dni;
			$this->Cliente->_fecha_nac = $this->request->nac;
			$this->Cliente->_nro_cliente = $this->request->nro;
			$this->Cliente->_domicilio = $this->request->dom;
			$this->Cliente->_localidad = $this->request->loc;
			$this->Cliente->_telefono = $this->request->tel;
			$this->Cliente->_correo = $this->request->correo;

			$resp = $this->Cliente->obtenerClienteNro();
			$cantidad = $resp->fields['cant'];
			// si es mayor a cero (0), ya existe el nro de cliente. dar error y retornar 
			if($cantidad > 0){

					$resultado->exito = false;
					$error->mensaje = 'El Número de cliente ya existe!';
					$resultado->error = $error;
					throw new \Exception("El Número de cliente ya existe!");

			}else{

				$resultado->listado = $this->Cliente->guardar();
            	$resultado->exito = true;

			}

			//code...
		} catch (\Exception $e) {

            if (!isset($error->mensaje))

			$error->mensaje = "error de clientes";

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;

		}

		return json_encode($resultado);

	}
	

	public function modificar(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

			$this->Cliente->_id = $this->request->id_cli;
			$this->Cliente->_nombre = $this->request->nom;
			$this->Cliente->_apellido = $this->request->ape;
			$this->Cliente->_dni = $this->request->dni;
			$this->Cliente->_fecha_nac = $this->request->nac;
			$this->Cliente->_domicilio = $this->request->dom;
			$this->Cliente->_nro_cliente = $this->request->nro;
			$this->Cliente->_localidad = $this->request->loc;
			$this->Cliente->_telefono = $this->request->tel;
			$this->Cliente->_correo = $this->request->correo;

            $resultado->listado = $this->Cliente->modificar();
            $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al modificar.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
	public function listado(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

			$resultado->listado = $this->Cliente->obtenerClientesAll();

				$arreglo = array();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
	public function listadoParaAutocompletar(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

				$r = $this->Cliente->obtenerClientesAll();

				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['id'],
						'label' => $value['apellido'].', '.$value['nombre'].' - '.$value['nro_cliente']
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
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
	
	public function obtenerClientePdf(){

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