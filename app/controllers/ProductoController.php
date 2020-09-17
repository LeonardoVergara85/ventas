<?php

namespace App\Controller;

use Core\Controller;
use App\Model\Producto;
use App\Model\Familia;

// clase requisitos
class ProductoController extends Controller
{
	private $Producto;
	private $Familia;

	// constructor de la clase
	function __construct()
	{

        $this->Producto = new Producto();
		$this->request = new \Core\Request();

	}
    
	//	funciones del controlador

	
	public function altaProductoStock(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {	


				$this->Producto->_id = $this->request->idp;
				$this->Producto->_codigo = $this->request->cod;
				$this->Producto->_descipcion = $this->request->desc;
				$this->Producto->_familia_id = $this->request->familia;
				$this->Producto->_medida = $this->request->med;
				if($this->request->tipo_med == ''){
					$this->Producto->_tipo_medida_id = null;
				}else{
					$this->Producto->_tipo_medida_id = $this->request->tipo_med;
				}
				
				$this->Producto->_talle = $this->request->talle;
				$this->Producto->_color = $this->request->color;
				$this->Producto->_aroma = $this->request->aroma;
				$this->Producto->_precio_costo = $this->request->costo;
				$this->Producto->_precio_sugerido = $this->request->sugerido;
				$this->Producto->_punto_reposicion = $this->request->repo;
				$this->Producto->_stock = $this->request->stock;


				$this->Producto->altaProdStock();
			
               $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Ocurrió un error! .";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	

	public function modificarProductoStock(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {	

				$this->Producto->_id = $this->request->idp;
				$this->Producto->_codigo = $this->request->cod;
				$this->Producto->_descipcion = $this->request->desc;
				$this->Producto->_familia_id = $this->request->familia;
				$this->Producto->_medida = $this->request->med;
				if($this->request->tipo_med == ''){
					$this->Producto->_tipo_medida_id = null;
				}else{
					$this->Producto->_tipo_medida_id = $this->request->tipo_med;
				}
				
				$this->Producto->_talle = $this->request->talle;
				$this->Producto->_color = $this->request->color;
				$this->Producto->_aroma = $this->request->aroma;
				$this->Producto->_precio_costo = $this->request->costo;
				$this->Producto->_precio_sugerido = $this->request->sugerido;
				$this->Producto->_punto_reposicion = $this->request->repo;
				$this->Producto->_stock = $this->request->stock;


				$this->Producto->modificarProdStock();
			
               $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Ocurrió un error! .";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	

	public function deleteProductoStock(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {	

				$this->Producto->_id = $this->request->id_producto;


				$this->Producto->deleteProdStock();
			
               $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Ocurrió un error! .";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function modificar(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {	


				$this->Producto->_id = $this->request->idp;
				$this->Producto->_codigo = $this->request->cod;
				$this->Producto->_descipcion = $this->request->desc;
				$this->Producto->_familia_id = $this->request->familia;
				$this->Producto->_medida = $this->request->med;
				if($this->request->tipo_med == ''){
					$this->Producto->_tipo_medida_id = null;
				}else{
					$this->Producto->_tipo_medida_id = $this->request->tipo_med;
				}
				
				$this->Producto->_talle = $this->request->talle;
				$this->Producto->_color = $this->request->color;
				$this->Producto->_aroma = $this->request->aroma;
				$this->Producto->_precio_costo = $this->request->costo;
				$this->Producto->_precio_sugerido = $this->request->sugerido;


				$this->Producto->modificar();
			
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

                $resultado->listado = $this->Producto->obtenerProductoAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	

	public function listadoSinstock(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

                $resultado->listado = $this->Producto->obtenerProductoSinStockAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	

	public function listadostock(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

                $resultado->listado = $this->Producto->obtenerProductoStockAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
	public function listadoXFamilias(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
				$this->Producto->_familia_id = $this->request->familia;
				$this->Producto->_fecha_alta = $this->request->lista;
				
                $resultado->listado = $this->Producto->obtenerProductoAllFamilias();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	
	public function listasprod(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
                $resultado->listado = $this->Producto->obtenerListas();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listasprod2(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
                $resultado->listado = $this->Producto->obtenerListas2();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoPedido(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

				$r = $this->Producto->obtenerProductoAll();
				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['ID'],
						'label' => $value['CODIGO'].' - '.$value['DESCRIPCION'].' ('.$value['FAMILIA'].')'
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los productos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function listadoPedido2(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {

			$this->Producto->_fecha_alta = $this->request->lista;
				$r = $this->Producto->obtenerProductoAll2();
				$arreglo = array();
				// armamos el arreglo con value y label para poder ser utilizado en el autocomplete Jquery UI
				// respetamos el formato del autocomplete
				foreach ($r as $value)
				{
					array_push($arreglo, [
						'value' => $value['ID'],
						'label' => $value['CODIGO'].' - '.$value['DESCRIPCION'].' ('.$value['FAMILIA'].')'
					]);
					
				}
				
				$resultado->listado = $arreglo;
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los productos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	

	public function obtenerProducto(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
				$this->Producto->_id = $this->request->id_producto;
                $resultado->listado = $this->Producto->obtenerProductoId();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}
	

	public function obtenerProductoStock(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
				$this->Producto->_id = $this->request->id_producto;
                $resultado->listado = $this->Producto->obtenerProductoIdStock();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar los turnos.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

	public function obtenerFamilias(){

        $error = new \stdClass();
        $resultado = new \stdClass();

		try {
				$this->Familia = new Familia();
				
                $resultado->listado = $this->Familia->obtenerFamiliaAll();
                $resultado->exito = true;
			
			//code...
		} catch (\Throwable $th) {

            $resultado = "Error al listar las familias.";
            $resultado->exito = false;

		}

		return json_encode($resultado);

	}

}