<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class Pedido extends Model
{

    public $_id;
    public $_cliente_id;
    public $_envio_id;
    public $_usuario_id;
    public $_fecha_cierre;
    public $_forma_pago_id;
    public $_tipo_descuento_id;
    public $_total;
    public $_descuento;
    public $_fecha_pago;
    public $_estado_id;
    public $_seña;
    public $_familia;
    public $_observacion;
    
    
    function __construct()
    { 

    }


    function guardar($data)
    {

        $cliente = $this->_cliente_id;
        $envio = $this->_envio_id;
        $usu = $this->_usuario_id;
        $fechac = $this->_fecha_cierre;
        $fp = $this->_forma_pago_id;
        $td = $this->_tipo_descuento_id;
        $total = $this->_total;
        $seña = $this->_seña;
        $des = $this->_descuento;
        $fechap = $this->_fecha_pago;
        $obs = $this->_observacion;

        

        $conexion = Database::DB();

        $conexion->startTrans();

        $sql = "CALL alta_pedido_p(?,?,?,?,?)";

        $consulta = $conexion->Prepare($sql);

        $conexion->Execute($consulta,array($cliente,$envio,$usu,$fechac,$obs));

        $sql_id = "SELECT @@identity AS id";
        $resp = $conexion->Execute($sql_id);
        
        $idp =  $resp->fields['id'];

        $sql2 = "CALL alta_pedido_pago_p(?,?,?,?,?,?,?)";

        $consulta2 = $conexion->Prepare($sql2);

        $conexion->Execute($consulta2,array($idp,$fp,$td,$total,$des,$fechap,$seña));

        
        $n = count($data);

        for ($i = 1; $i < $n; $i++) {
            //medidas
            if($data[$i][10] != ''){
                $sqlmed = "SELECT id AS med FROM medidas WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][10]));

                if($rtamed->fields['med'] == null){

                    $sqlmed = "INSERT INTO medidas (id,descripcion,familia_id) VALUES (NULL,?,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][10],$data[$i][14]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $idm =  $resp->fields['id'];

                }else{
                    $idm = $rtamed->fields['med']; 
                }
            }else{
                $idm = $data[$i][4]; 
            }
            

            //talles
            if($data[$i][11] != ''){
                $sqlmed = "SELECT id AS ta FROM talles WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][11]));

                if($rtamed->fields['ta'] == null){

                    $sqlmed = "INSERT INTO talles (id,descripcion,familia_id) VALUES (NULL,?,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][11],$data[$i][14]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $idt =  $resp->fields['id'];

                }else{
                    $idt = $rtamed->fields['ta']; 
                }

            }else{
                $idt = $data[$i][5]; 
            }
            
            //color
            if($data[$i][12] != ''){
                $sqlmed = "SELECT id AS col FROM colores WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][12]));

                if($rtamed->fields['col'] == null){

                    $sqlmed = "INSERT INTO colores (id,descripcion) VALUES (NULL,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][12]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $idc =  $resp->fields['id'];

                }else{
                    $idc = $rtamed->fields['col']; 
                }

            }else{
                $idc = $data[$i][6]; 
            }
            
            //aroma
            if($data[$i][13] != ''){
                $sqlmed = "SELECT id AS aro FROM aromas WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][13]));

                if($rtamed->fields['aro'] == null){

                    $sqlmed = "INSERT INTO aromas (id,descripcion) VALUES (NULL,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][13]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $ida =  $resp->fields['id'];

                }else{

                    $ida = $rtamed->fields['aro']; 

                }

            }else{

                $ida = $data[$i][7]; 

            }
            
            // insertamos en detalles de pedidos
            $sql_prod = "CALL alta_prod_pedido_p(?,?,?,?,?,?,?,?,?,?)";

            $consulta_prod = $conexion->Prepare($sql_prod);
            $consulta = $conexion->Execute($consulta_prod,array($idp,$data[$i][0],$data[$i][8],'S',$data[$i][1],$data[$i][3],$idm,$idt,$idc,$ida));
        }

        $conexion->completeTrans();
    
		return $consulta;
    }

    function modificar($data)
    {

        $id = $this->_id;
        $cliente = $this->_cliente_id;
        $envio = $this->_envio_id;
        $usu = $this->_usuario_id;
        $fechac = $this->_fecha_cierre;
        $fp = $this->_forma_pago_id;
        $td = $this->_tipo_descuento_id;
        $total = $this->_total;
        $seña = $this->_seña;
        $des = $this->_descuento;
        $fechap = $this->_fecha_pago;
        $obs = $this->_observacion;

        

        $conexion = Database::DB();

         $conexion->startTrans();
            ///
         $sql = "UPDATE pedido 
                SET CLIENTE_ID = ?, ENVIO_ID = ?, FECHA_CIERRE = ?, OBSERVACION = ?
                WHERE ID = ?";

         $consulta = $conexion->Prepare($sql);
        
         $consulta = $conexion->Execute($consulta,array($cliente,$envio,$fechac,$obs,$id));
         
            ///
         $sql2 = "UPDATE pedido_pago 
                SET FORMA_PAGO_ID = ?, TIPO_DESCUENTO_ID = ?, PRECIO_TOTAL = ?, DESCUENTO = ?, SENIA = ?
                 WHERE PEDIDO_ID = ?";

         $consulta2 = $conexion->Prepare($sql2);

         $consulta2 = $conexion->Execute($consulta2,array($fp,$td,$total,$des,$seña,$id));
         
            ///
        $sql3 = "DELETE FROM pedido_detalle WHERE pedido_id = ?";

        $consulta3 = $conexion->Prepare($sql3);

        $consulta3 = $conexion->Execute($consulta3,array($id));   
        
         
        $n = count($data);
       
        $llego = 'S';
        for ($i = 1; $i < $n; $i++) {
            if($data[$i][9] == 'false'){
                $llego = 'N';  
            }else{
                $llego = 'S';  
            }
             //medidas
             if($data[$i][10] != ''){
                $sqlmed = "SELECT id AS med FROM medidas WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][10]));

                if($rtamed->fields['med'] == null){

                    $sqlmed = "INSERT INTO medidas (id,descripcion,familia_id) VALUES (NULL,?,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][10],$data[$i][14]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $idm =  $resp->fields['id'];

                }else{
                    $idm = $rtamed->fields['med']; 
                }
            }else{
                $idm = $data[$i][4]; 
            }
            

            //talles
            if($data[$i][11] != ''){
                $sqlmed = "SELECT id AS ta FROM talles WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][11]));

                if($rtamed->fields['ta'] == null){

                    $sqlmed = "INSERT INTO talles (id,descripcion,familia_id) VALUES (NULL,?,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][11],$data[$i][14]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $idt =  $resp->fields['id'];

                }else{
                    $idt = $rtamed->fields['ta']; 
                }

            }else{
                $idt = $data[$i][5]; 
            }
            
            //color
            if($data[$i][12] != ''){
                $sqlmed = "SELECT id AS col FROM colores WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][12]));

                if($rtamed->fields['col'] == null){

                    $sqlmed = "INSERT INTO colores (id,descripcion) VALUES (NULL,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][12]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $idc =  $resp->fields['id'];

                }else{
                    $idc = $rtamed->fields['col']; 
                }

            }else{
                $idc = $data[$i][6]; 
            }
            
            //aroma
            if($data[$i][13] != ''){
                $sqlmed = "SELECT id AS aro FROM aromas WHERE descripcion = ? ";
                $consultamed = $conexion->Prepare($sqlmed);
                $rtamed = $conexion->Execute($consultamed,array($data[$i][13]));

                if($rtamed->fields['aro'] == null){

                    $sqlmed = "INSERT INTO aromas (id,descripcion) VALUES (NULL,?)";
                    $consultamed = $conexion->Prepare($sqlmed);
                    $rtamed = $conexion->Execute($consultamed,array($data[$i][13]));

                    $sql_id = "SELECT @@identity AS id";
                    $resp = $conexion->Execute($sql_id);
            
                    $ida =  $resp->fields['id'];

                }else{
                    $ida = $rtamed->fields['aro']; 
                }

            }else{
                $ida = $data[$i][7]; 
            }

            $sql_prod = "CALL alta_prod_pedido_p(?,?,?,?,?,?,?,?,?,?)";

            $consulta_prod = $conexion->Prepare($sql_prod);
            $consulta_prod = $conexion->Execute($consulta_prod,array($id,$data[$i][0],$data[$i][8],$llego,$data[$i][1],$data[$i][3],$idm,$idt,$idc,$ida));
        }
    
         $conexion->completeTrans();
    
		 return $consulta;
    }


    function obtenerPedidosAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM pedidos_vw";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerPedidosId()
    {
        
        $conexion = Database::DB();
        $id = $this->_id;

        $sql = "SELECT * FROM pedidos_vw where id = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($id));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerEstadosAll()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM estado_pedido WHERE id <> 9";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerEstadosAll2()
    {
        
        $conexion = Database::DB();

        $sql = "SELECT * FROM estado_pedido";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function cambiarEstado()
    {
        $id = $this->_id;
        $est = $this->_estado_id;

        $conexion = Database::DB();

        $sql = "UPDATE pedido SET estado_id = ? WHERE id = ? ";

       $consulta =$conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($est,$id));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    
    function cambiarEstadoStock()
    {
        $id = $this->_id;
        $est = $this->_estado_id;

        $conexion = Database::DB();

        $conexion->startTrans(); // inicio de la transacción

        $sql = "UPDATE pedido SET estado_id = ? WHERE id = ? ";

       $consulta =$conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($est,$id));

        // buscamos los productos con stock  //

        $sql2 = "SELECT pd.producto_id, pd.cantidad, s.cantidad AS stock
                FROM pedido_detalle pd
                INNER JOIN producto p ON (pd.producto_id = p.id)
                INNER JOIN stock s ON (s.producto_id = p.id)
                WHERE pedido_id = ? ";

        $consulta2 =$conexion->Prepare($sql2);
        $consulta2 = $conexion->Execute($consulta2,array($id));
      
        // - agregamos los datos de la consulta en un arreglo //

        $resultado = array();
		while ($r = $consulta2->fetchRow()){
            $resultado[] = $r;
        }
        
        // - descontamos las cantidades al stock de los productos encontrados //
        foreach($resultado as $value ){

            $sql3 = "UPDATE stock SET cantidad = (cantidad - ?) WHERE producto_id = ? ";

            $consulta3 =$conexion->Prepare($sql3);
            $conexion->Execute($consulta3,array($value['cantidad'],$value['producto_id']));
        }
        
        $conexion->completeTrans(); // fin de la transacción

        return $resultado;
    }

    function eliminar()
    {
        $id = $this->_id;

        $conexion = Database::DB();

        $sql = "UPDATE pedido SET activo = 'N' WHERE id = ? ";

       $consulta =$conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($id));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerMedidas()
    {
        $fam = $this->_familia;
        $conexion = Database::DB();
        $sql = "SELECT * FROM medidas where familia_id = ?";

        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($fam));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerTalles()
    {
        $fam = $this->_familia;
        $conexion = Database::DB();
        $sql = "SELECT * FROM talles where familia_id = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($fam));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerColores()
    {
        
        $conexion = Database::DB();
        $sql = "SELECT * FROM colores";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerAromas()
    {
        
        $conexion = Database::DB();
        $sql = "SELECT * FROM aromas";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

}
