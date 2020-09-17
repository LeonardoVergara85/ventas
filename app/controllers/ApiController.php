<?php

namespace App\Controller;

use Core\Controller;
use App\Model\Configuracion;
use App\Model\Turnos;
use App\Model\TurnosHabilitados;
use App\Model\TurnoTipo;
use App\Model\Persona;
use App\Model\Oficinas;
use App\Model\Grupo;
use App\Model\Parametro;
use App\Model\Acta;

// clase requisitos
class ApiController extends Controller
{
	private $Configuracion;
	private $Turnos;
	private $TurnosHabilitados;
	private $TurnoTipo;
	private $Persona;
	private $Oficinas;
	private $Grupo;
	private $Parametro;
	private $Acta;

	// constructor de la clase
	function __construct()
	{

		$this->Configuracion = new Configuracion();
		$this->Turnos = new Turnos();
		$this->TurnosHabilitados = new TurnosHabilitados();
		$this->TurnoTipo = new TurnoTipo();

		$this->request = new \Core\Request();

	}
    
	//	funciones del controlador
	
	public function tipoTurnos(){

		$error = new \stdClass();

		try {

			$idg = filter_var( $this->request->idg , FILTER_VALIDATE_INT) ;

				if( ($idg == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}

			$general = $this->request->general;
			$this->TurnoTipo->grupo = $this->request->idg;

			if($general == TRUE){

				$resultado = $this->TurnoTipo->listadoTipoTurnoApiGeneral();

			}else{

				$resultado = $this->TurnoTipo->listadoTipoTurnoApi();

			}
			
			//code...
		} catch (\Throwable $th) {

			$resultado = "Error al listar los turnos.";

		}

		return json_encode($resultado);

	}


	
	public function turnosDisponiblesGet(){

		$error = new \stdClass();

		try {
			
			$resultado = $this->TurnosHabilitados->buscarTurnosDisponiblesGet();
			//code...
		} catch (\Throwable $th) {

			$resultado = "Error al listar los turnos.";

		}

		return json_encode($resultado);

	}

    public function buscarTurnosCliente()
    {

	
		$error = new \stdClass();

		try {

			//dump($this->request);
			//////////////---------------- validación ----------------//////////////
			$myregex = "~^\d{2}/\d{2}/\d{4}$~"; // valida fecha -> dd/mm/yyyy
			$resul = filter_var( $this->request->oficina , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->tipo_turno , FILTER_VALIDATE_INT) ;
			//$resul_3 = filter_var( $this->request->iddt , FILTER_VALIDATE_INT) ;
			//$dia_ = filter_var($this->request->dia,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $myregex)) );
			

				if( ( $resul == FALSE) || ( $resul_2 == FALSE) ){

					$error->mensaje = 'Los datos ingresados son erroneos';
					throw new \Exception("Los datos ingresados son erroneos");
						
				}
			
			//////////////---------------- fin validación ----------------//////////////
			
			$this->Configuracion->entidad_id = $this->request->oficina;
			$this->Configuracion->tur_base_id = $this->request->tipo_turno;
			$this->Configuracion->mes = $this->request->mes;
			$this->Configuracion->anio = $this->request->anio;

			$resultado = $this->Configuracion->buscarTurHab();

		} catch (\Exception $e) {
			// if (!isset($error->mensaje))
			// 	$error->mensaje = 'Error al listar los datos.';

		    //  $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			// $resultado->exito = false;
            // $resultado->error = $error;+
            $resultado = "Error al listar los turnos.";
		}

		return json_encode($resultado);
      
	}

	//obtener personas de BDU
	public function obtenerPersonasBdu()
    {

	
		$error = new \stdClass();
		$resultado = new \stdClass();

		$this->Persona = new Persona();

		try {

			//////////////---------------- validación ----------------//////////////
			$regex_letras = "/^[a-zA-Z]+/";
			$resul = filter_var( $this->request->documento , FILTER_VALIDATE_INT) ;
			$doc_length = strlen((string)$this->request->documento);
			$sexo = filter_var($this->request->sexo,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $regex_letras)) );
			$doclength = FALSE;
			if($doc_length == 7 || $doc_length == 8){		// verificamos que la longitud del documento sea 7 u 8 solamente
					$doclength = TRUE;
			}
				if( ( $resul == FALSE) ||  ($doclength != TRUE) || ($sexo == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}
			
			//////////////---------------- fin validación ----------------//////////////
			
			
			$this->Persona->_dni = $this->request->documento;
			$this->Persona->_sexo = $this->request->sexo;

			$resultado = $this->Persona->obtenerPersona();

		} catch (\Exception $e) {

			if (!isset($error->mensaje))

			$error->mensaje = "No se encuentra la persona. Verifique los datos ingresados y si el problema persiste, por favor comuníquese con nosotros para poder solucionarlo.";

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		
		}

		return json_encode($resultado);
      
	}


	//saber si esta digitalizada o no el acta
   
	public function obtenerPersonasActas(){

	
		$error = new \stdClass();
		$resultado = new \stdClass();

		$this->Persona = new Persona();

		try {

			//////////////---------------- validación ----------------//////////////
			$regex_letras = "/^[a-zA-Z]+/";
			$resul = filter_var( $this->request->documento , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->ttur_desc,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $regex_letras)) ) ;
			$doc_length = strlen((string)$this->request->documento);
			$sexo = filter_var($this->request->sexo,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $regex_letras)) );
			$doclength = FALSE;
			if($doc_length == 7 || $doc_length == 8){		// verificamos que la longitud del documento sea 7 u 8 solamente
					$doclength = TRUE;
			}
				if( ( $resul == FALSE) || ($resul_2 != TRUE) || ($doclength != TRUE) || ($sexo == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}
			
			//////////////---------------- fin validación ----------------//////////////
			
			
			$this->Persona->_dni = $this->request->documento;
			$this->Persona->_ttur = $this->request->ttur_desc;
			$this->Persona->_sexo = $this->request->sexo;

			$resultado = $this->Persona->obtenerPersonaActa();
			if($resultado == ' '){
				$resultado = false;
			}else{
				$resultado = true;
			}


		} catch (\Exception $e) {

			if (!isset($error->mensaje))
			$error->mensaje = 'No se encuentra la persona.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		
		}

		return json_encode($resultado);
      
	}


	//saber si esta digitalizada o no el acta pasando todos los campos
   
	public function obtenerActas(){

	
		$error = new \stdClass();
		$resultado = new \stdClass();

		$this->Acta = new Acta();

		try {

			//////////////---------------- validación ----------------//////////////
			$regex_letras = "/^[a-zA-Z]+/";
			$anio = filter_var( $this->request->anio , FILTER_VALIDATE_INT) ;
			$ttur = filter_var( $this->request->ttur , FILTER_VALIDATE_INT) ;
			$fol = filter_var( $this->request->folio , FILTER_VALIDATE_INT) ;
			$acta = filter_var( $this->request->nro_acta , FILTER_VALIDATE_INT) ;

			$tomo = filter_var( $this->request->tomo,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $regex_letras)) ) ;
			$ofi = filter_var($this->request->oficina,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $regex_letras)) );
		
		
			if( ( $anio == FALSE) || ( $ttur == FALSE) || ( $fol == FALSE) || ( $acta == FALSE) || ($tomo == FALSE) || ($ofi == FALSE) ){

				$resultado->exito = false;
				$error->mensaje = 'Los datos ingresados son erroneos';
				$resultado->error = $error;
				throw new \Exception("Los datos ingresados son erroneos");
					
			}
			
			//////////////---------------- fin validación ----------------//////////////
			

			// $this->Acta->_tipo = $this->request->ttur;
			$tipo = $this->request->ttur;

			$this->Acta->_oficina = $this->request->oficina;
			$this->Acta->_anio = $this->request->anio;
			$this->Acta->_tomo = $this->request->tomo;
			$this->Acta->_folio = $this->request->folio;
			$this->Acta->_nro_acta = $this->request->nro_acta;

			switch ($tipo) {

				case 2:
					$resultado = $this->Acta->obtenerActaNacimiento();
					break;
				case 3:
					$resultado = $this->Acta->obtenerActaDefuncion();
					break;
				case 4:
					$resultado = $this->Acta->obtenerActaMatrimonio();
					break;
				case 5:
					$resultado = $this->Acta->obtenerActaUniones();
					break;	

			}


			if($resultado == NULL){

				return false;

			}else{

				return true;
			}
	
			//return $resultado;	

		} catch (\Exception $e) {

			if (!isset($error->mensaje))
			$error->mensaje = 'No se encuentra la persona.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		
		}

		return json_encode($resultado);
      
	}

	public function turnosDisponibles(){

		$error = new \stdClass();
		$resultado = new \stdClass();
		

		try {

			//////////////---------------- validación ----------------//////////////

			$resul = filter_var( $this->request->entidad , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->ttur_base , FILTER_VALIDATE_INT) ;
			$mes_ = filter_var( $this->request->mes , FILTER_SANITIZE_STRING) ;
			$anio_ = filter_var( $this->request->anio , FILTER_SANITIZE_STRING) ;
		

			$strlth_m =  strlen($mes_);
			$strlth_a =  strlen($anio_);

			
				if( ( $resul == FALSE) || ( $resul_2 == FALSE) || ( $mes_ == FALSE) || ( $anio_ == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}else if(($strlth_m != 2) || ($strlth_a != 4)){
					
					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");

				}

			//////////////---------------- fin validación ----------------//////////////
			
			$this->TurnosHabilitados->entidad_id = $this->request->entidad;
			$this->TurnosHabilitados->tur_base_id = $this->request->ttur_base;
			$this->TurnosHabilitados->mes = $this->request->mes;
			$this->TurnosHabilitados->anio = $this->request->anio;
			$resultado->exito = true;
			$resultado = $this->TurnosHabilitados->buscarTurnosDisponibles();
			
			//code...
		} catch (\Exception $e) {

			if (!isset($error->mensaje))
			$error->mensaje = 'No se encuentra la persona.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;

		//	$resultado = "Error al listar los turnos.";

		}

		return json_encode($resultado);

	}

	public function turnosDisponiblesAll(){


		$this->Parametro = new Parametro();
		$error = new \stdClass();
		$resultado = new \stdClass();
		$dias = NULL;
		

		try {

			//////////////---------------- validación ----------------//////////////

			$resul = filter_var( $this->request->entidad , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->ttur_base , FILTER_VALIDATE_INT) ;


			
				if( ( $resul == FALSE) || ( $resul_2 == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}

			//////////////---------------- fin validación ----------------//////////////

			$this->Parametro->oficina = $this->request->entidad;
			$this->Parametro->ttur_id = $this->request->ttur_base;
			$rta = $this->Parametro->buscar();

			$esta_digitalizada = $this->request->dig;

			if($esta_digitalizada == true){

				$dias = intval($rta[0]['DIAS_DIG']);
			

			}else{

				$dias = intval($rta[0]['DIAS_NO_DIG']);
			
			}
			
			$this->TurnosHabilitados->entidad_id = $this->request->entidad;
			$this->TurnosHabilitados->tur_base_id = $this->request->ttur_base;

			
			$tipobusqueda = 'todo';

			$resultado = $this->TurnosHabilitados->buscarTurnosDisponiblesAll($tipobusqueda,$dias);

			//$resultado->exito = true;
			//code...
		} catch (\Exception $e) {

			if (!isset($error->mensaje))
			$error->mensaje = 'No se encuentra la persona.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;

		//	$resultado = "Error al listar los turnos.";

		}

		return json_encode($resultado);

	}


	public function turnosDisponiblesAllFecha(){

		$this->Parametro = new Parametro();
		$error = new \stdClass();
		$resultado = new \stdClass();
		$dias = NULL;

		try {

			//////////////---------------- validación ----------------//////////////

			$resul = filter_var( $this->request->entidad , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->ttur_base , FILTER_VALIDATE_INT) ;


			
				if( ( $resul == FALSE) || ( $resul_2 == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}

			//////////////---------------- fin validación ----------------//////////////
			
			$this->Parametro->oficina = $this->request->entidad;
			$this->Parametro->ttur_id = $this->request->ttur_base;
			$rta = $this->Parametro->buscar();

			$esta_digitalizada = $this->request->dig;

			if($esta_digitalizada == true){

				$dias = intval($rta[0]['DIAS_DIG']);
			

			}else{

				$dias = intval($rta[0]['DIAS_NO_DIG']);
			
			}
		
			// var_dump($rta[0]['DIAS_DIG']);
			// var_dump($rta[0]['DIAS_NO_DIG']);
			// //VAR_DUMP($rta);
			// VAR_DUMP($esta_digitalizada);
			// VAR_DUMP($dias);
			// //exit();

			$this->TurnosHabilitados->entidad_id = $this->request->entidad;
			$this->TurnosHabilitados->tur_base_id = $this->request->ttur_base;

			$tipobusqueda = 'fechas';
			$resultado = $this->TurnosHabilitados->buscarTurnosDisponiblesAll($tipobusqueda,$dias);

			//var_dump($resultado);
			//$resultado->exito = true;
			
			//code...
		} catch (\Exception $e) {

			if (!isset($error->mensaje))
			$error->mensaje = 'No se encuentra la persona.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;

		//	$resultado = "Error al listar los turnos.";

		}

		return json_encode($resultado);

	}

	public function buscarTurno(){

		$error = new \stdClass();
		$resultado = new \stdClass();
		

		try {

			//////////////---------------- validación ----------------//////////////

			
	
			if( $this->request->ids != NULL ){

				$ids = filter_var( $this->request->ids , FILTER_VALIDATE_INT) ;
				$ide = filter_var( $this->request->ent_id , FILTER_VALIDATE_INT) ;

				if( ($ids == FALSE) || ($ide == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}else{
				
					$this->Turnos->solicitud_id = $this->request->ids;
					$this->Turnos->entidad_id = $this->request->ent_id;

					$resultado = $this->Turnos->buscarTurnoId();

				}


			}else{

				$resul = filter_var( $this->request->per_sol , FILTER_VALIDATE_INT) ;
				$resul_2 = filter_var( $this->request->ttur , FILTER_VALIDATE_INT) ;
				$ide = filter_var( $this->request->ent_id , FILTER_VALIDATE_INT) ;

				if( ($resul == FALSE) || ($resul_2 == FALSE) ){

					$resultado->exito = false;
					$error->mensaje = 'Los datos ingresados son erroneos';
					$resultado->error = $error;
					throw new \Exception("Los datos ingresados son erroneos");
						
				}else{

					$this->Turnos->prs_sol_id = $this->request->per_sol;
					$this->Turnos->tipo_turno = $this->request->ttur;
					$this->Turnos->entidad_id = $this->request->ent_id;

					$resultado = $this->Turnos->buscarTurnoPerTipo();


				}

			}
				

			//////////////---------------- fin validación ----------------//////////////
			
			

			//$resultado->exito = true;
			
			//code...
		} catch (\Exception $e) {

			if (!isset($error->mensaje))
			$error->mensaje = 'No se encuentra la persona.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;

			//	$resultado = "Error al listar los turnos.";

		}

		return json_encode($resultado);

	}



	public function buscarOficina()
    {
		$this->Oficinas = new Oficinas();
		$resultado = new \stdClass();
		$error = new \stdClass();

		try {

			//////////////---------------- validación ----------------//////////////

			$resul = filter_var( $this->request->ent_id , FILTER_VALIDATE_INT) ;


				if( ( $resul == FALSE) ){

					$error->mensaje = 'Los datos ingresados son erroneos';
					throw new \Exception("Los datos ingresados son erroneos");
						
				}
			
			//////////////---------------- fin validación ----------------//////////////
      
            $this->Oficinas->entidad_id = $this->request->ent_id;
			$resultado->listado = $this->Oficinas->buscarDatosOficina();
			$resultado->exito = true;
			
		} catch (\Exception $e) {
			
			if (!isset($error->mensaje))
			$error->mensaje = 'Error.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		}

		return json_encode($resultado);
      
	}

	
	public function listadoOficinasCargadas()
    {
		$this->Oficinas = new Oficinas();
		$resultado = new \stdClass();
		$error = new \stdClass();

		try {

			//////////////---------------- validación ----------------//////////////

			$resul = filter_var( $this->request->id_ttur , FILTER_VALIDATE_INT) ;


				if( ( $resul == FALSE) ){

					$error->mensaje = 'Los datos ingresados son erroneos';
					throw new \Exception("Los datos ingresados son erroneos");
						
				}
			
			//////////////---------------- fin validación ----------------//////////////
      
            $this->Oficinas->tur_base_id = $this->request->id_ttur;
			$resultado->listado = $this->Oficinas->listado_oficinas_activas();
			$resultado->exito = true;
			
		} catch (\Exception $e) {
			
			if (!isset($error->mensaje))
			$error->mensaje = 'Error.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		}

		return json_encode($resultado);
      
	}

	public function buscarGrupoPagina()
    {
		$this->Grupo = new Grupo();
		$resultado = new \stdClass();
		$error = new \stdClass();

		try {

			//////////////---------------- validación ----------------//////////////

			$resul = filter_var( $this->request->id_grupo , FILTER_VALIDATE_INT) ;


				if( ( $resul == FALSE) ){

					$error->mensaje = 'Los datos ingresados son erroneos';
					throw new \Exception("Los datos ingresados son erroneos");
						
				}
			
			//////////////---------------- fin validación ----------------//////////////
      
            $this->Grupo->id = $this->request->id_grupo;
			$resultado->listado = $this->Grupo->buscarGrupo();
			$resultado->exito = true;
			
		} catch (\Exception $e) {
			
			if (!isset($error->mensaje))
			$error->mensaje = 'Error.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		}

		return json_encode($resultado);
      
	}
	

	public function guardarTurno()
    {
		$this->Turnos = new Turnos();
		$resultado = new \stdClass();
		$error = new \stdClass();

		try {

			//////////////---------------- validación ----------------//////////////
			$myregex = "~^\d{2}/\d{2}/\d{4}$~"; // valida fecha -> dd/mm/yyyy
			$resul = filter_var( $this->request->ttur , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->ent_id , FILTER_VALIDATE_INT) ;
			$resul_3 = filter_var( $this->request->prs , FILTER_VALIDATE_INT) ;
			$resul_4 = filter_var($this->request->mail , FILTER_VALIDATE_EMAIL);
			$fecha = filter_var($this->request->fecha,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=> $myregex)) );
			$telefono = strlen((string)$this->request->tel);
			$tp = $this->request->tp;
			
				if( ( $resul == FALSE) || ( $resul_2 == FALSE) || ( $resul_3 == FALSE) || ( $fecha == FALSE) ){

					$error->mensaje = 'Los datos ingresados son erroneos enteros';
					throw new \Exception("Los datos ingresados son erroneos");
						
				}else if(($telefono < 10) || ($telefono > 14)){

					$error->mensaje = 'Los datos ingresados son erroneos telefono';
					throw new \Exception("Los datos ingresados son erroneos");

				}else if(($tp != 'M') && ($tp != 'F')){
					
					$error->mensaje = 'Los datos ingresados son erroneos sexo';
					throw new \Exception("Los datos ingresados son erroneos");

				}

			
			
			//////////////---------------- fin validación ----------------//////////////
      
            $this->Turnos->tipo_turno = $this->request->ttur;
            $this->Turnos->entidad_id = $this->request->ent_id;
            $this->Turnos->fecha = $this->request->fecha;
			$this->Turnos->hora = $this->request->hora;
			$this->Turnos->token = $this->request->token;
			$this->Turnos->prs_sol_id = $this->request->prs;
			$this->Turnos->tipo_prs = $this->request->tp;
			$this->Turnos->email = $this->request->mail;
			$this->Turnos->telefono = $this->request->tel;



			
			$resultado_insert = $this->Turnos->guardar();
			$resultado->exito = true;
			return $resultado_insert;
			
		} catch (\Exception $e) {
			
			if (!isset($error->mensaje))
			$error->mensaje = 'Error.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		}

		return json_encode($resultado);
      
	}


	public function cancelarTurno()
    {
		$this->Turnos = new Turnos();
		$resultado = new \stdClass();
		$error = new \stdClass();

		try {

			//////////////---------------- validación ----------------//////////////
		
			$resul = filter_var( $this->request->id_sol , FILTER_VALIDATE_INT) ;
			$resul_2 = filter_var( $this->request->prs_sol , FILTER_VALIDATE_INT) ;

			
				if( ( $resul == FALSE) || ( $resul_2 == FALSE) ){

					$error->mensaje = 'Los datos ingresados son erroneos enteros';
					throw new \Exception("Los datos ingresados son erroneos");
					
				}

			
			
			//////////////---------------- fin validación ----------------//////////////
      
            $this->Turnos->solicitud_id = $this->request->id_sol;
            $this->Turnos->prs_sol_id = $this->request->prs_sol;

			$resultado_insert = $this->Turnos->cancelar();

			$resultado->exito = true;
			return $resultado_insert;
			
		} catch (\Exception $e) {
			
			if (!isset($error->mensaje))
			$error->mensaje = 'Error.';

		    $error->descripcion = strtolower($_ENV['APP_DEBUG']) == 'true' ? $e->getMessage() : $error->mensaje;

			$resultado->exito = false;
			$resultado->error = $error;
		}

		return json_encode($resultado);
      
	}
  
 
}