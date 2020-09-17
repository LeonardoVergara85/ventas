<?php

namespace App\Controller;

use Core\Controller;
use App\Model\Cliente;
use App\Model\FormaEnvio;
use App\Model\FormaPago;
use App\Model\Pedido;
use App\Model\Producto;



class PedidoController extends Controller
{
	private $Cliente;
	private $formaEnvio;
	private $FormaPago;
	private $Pedido;
	private $Producto;

	// constructor de la clase
	function __construct()
	{

		$this->request = new \Core\Request();

	}
    
	//	funciones del controlador

	public function guardarPedido(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {	

				$this->Pedido->_cliente_id = $this->request->cliente;
				$this->Pedido->_envio_id = $this->request->envio;
				$this->Pedido->_usuario_id = $this->request->usu;
				$this->Pedido->_fecha_cierre = $this->request->fechac;
				$this->Pedido->_forma_pago_id = $this->request->fpago;
				$this->Pedido->_tipo_descuento_id = $this->request->tipod;
				$this->Pedido->_total = $this->request->total;
				$this->Pedido->_seña = $this->request->senia;
				$this->Pedido->_observacion = $this->request->observacion;

				if($this->request->tipod == 1){
					$this->Pedido->_descuento = $this->request->descuentop;
				}else{
					$this->Pedido->_descuento = $this->request->descuentoc;
				}
				
				$this->Pedido->_fecha_pago = $this->request->fechap;

				$data = $this->request->array;

				$this->Pedido->guardar($data);
			
               $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al guardar.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
	public function modificarPedido(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {	

				$this->Pedido->_id = $this->request->idp;
				$this->Pedido->_cliente_id = $this->request->cliente;
				$this->Pedido->_envio_id = $this->request->envio;
				$this->Pedido->_usuario_id = $this->request->usu;
				$this->Pedido->_fecha_cierre = $this->request->fechac;
				$this->Pedido->_forma_pago_id = $this->request->fpago;
				$this->Pedido->_tipo_descuento_id = $this->request->tipod;
				$this->Pedido->_total = $this->request->total;
				$this->Pedido->_seña = $this->request->senia;
				$this->Pedido->_observacion = $this->request->observacion;

				if($this->request->tipod == 1){
					$this->Pedido->_descuento = $this->request->descuentop;
				}else{
					$this->Pedido->_descuento = $this->request->descuentoc;
				}
				
				$this->Pedido->_fecha_pago = $this->request->fechap;

				$data = $this->request->array;

				$this->Pedido->modificar($data);
			
               $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al guardar.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoPedidos(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
                $resultado->listado = $this->Pedido->obtenerPedidosAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los pedidos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function pedidoId(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
			$this->Pedido->_id = $this->request->idp;
                $resultado->listado = $this->Pedido->obtenerPedidosId();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los pedidos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function productosPedidoId(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Producto = new Producto();

		try {

			    $this->Producto->_idpedido = $this->request->idp;
                $resultado->listado = $this->Producto->obtenerProductosIdPedido();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los pedidos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}


	public function productosPedidos(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Producto = new Producto();

		try {

                $resultado->listado = $this->Producto->obtenerProductosPedidos();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los pedidos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	

	public function productosPedidosTodos(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Producto = new Producto();

		try {

				$this->Producto->_estado_pedido = $this->request->estado;
                $resultado->listado = $this->Producto->obtenerProductosPedidosTodos();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los pedidos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
    public function listadoFormadeEnvio(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->formaEnvio = new FormaEnvio();

		try {
                $resultado->listado = $this->formaEnvio->obtenerFormasEnvioAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoFormadePago(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->FormaPago = new FormaPago();

		try {
                $resultado->listado = $this->FormaPago->obtenerFormasPagoAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoEstado(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
                $resultado->listado = $this->Pedido->obtenerEstadosAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoEstadoAll(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
                $resultado->listado = $this->Pedido->obtenerEstadosAll2();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los clientes.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	

	public function listadoMedidas(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
				$this->Pedido->_familia = $this->request->familia_id;
				
				$r = $resultado->listado = $this->Pedido->obtenerMedidas();
		

				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['id'],
						'label' => $value['descripcion']
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar las medidas.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoTalles(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {	
				$this->Pedido->_familia = $this->request->familia_id;
				$r = $resultado->listado = $this->Pedido->obtenerTalles();
				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['id'],
						'label' => $value['descripcion']
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los talles.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoColores(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
				$r = $resultado->listado = $this->Pedido->obtenerColores();
				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['id'],
						'label' => $value['descripcion']
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los colores.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoAromas(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
				$r = $resultado->listado = $this->Pedido->obtenerAromas();
				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['id'],
						'label' => $value['descripcion']
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los aromas.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function cambiarEstadoPedido(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
				$this->Pedido->_id = $this->request->id;
				$this->Pedido->_estado_id = $this->request->estado;
				if($this->request->estado == 7){

					$resultado->listado = $this->Pedido->cambiarEstadoStock();

				}else{
					$resultado->listado = $this->Pedido->cambiarEstado();
				}
                
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error cambiar el estado.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
	public function eliminarPedido(){

        $error = new \stdClass();
        $resultado = new \stdClass();
        $this->Pedido = new Pedido();

		try {
				$this->Pedido->_id = $this->request->idpedido;

                $resultado->listado = $this->Pedido->eliminar();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error cambiar el estado.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}




}