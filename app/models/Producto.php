<?php
namespace App\Model;

use Core\Model;
use Core\Database;

class Producto extends Model
{
 public $_id;
 public $_codigo;
 public $_descipcion;
 public $_idpedido;
 public $_estado_pedido;
 public $_familia_id;
 public $_medida;
 public $_tipo_medida_id;
 public $_talle;
 public $_color;
 public $_aroma;
 public $_fecha_alta;
 public $_fecha_baja;
 public $_precio_costo;
 public $_precio_sugerido;
 public $_punto_reposicion;
 public $_stock;



    function __construct()
    { 

    }

    
    function altaProdStock()
    {

        $id =  $this->_id;
        $cod = $this->_codigo;
        $desc = $this->_descipcion;
        $familia = $this->_familia_id;
        $med = $this->_medida;
        $tipom = $this->_tipo_medida_id;
        $talle = $this->_talle;
        $color = $this->_color;
        $aroma = $this->_aroma;
        $costo = $this->_precio_costo;
        $sugerido = $this->_precio_sugerido;
        $repo = $this->_punto_reposicion;
        $stock = $this->_stock;
                

        $conexion = Database::DB();

         $conexion->startTrans();
           
         $sql = "INSERT INTO producto (id,codigo,descripcion,familia_id,medida,medida_id,talles,color,aromas,costo,sugerido,fecha_alta,fecha_baja,activo)
                 VALUES (NULL,?,?,?,?,?,?,?,?,?,?,'0000-00-00',NULL,'S')";

         $consulta = $conexion->Prepare($sql);

         $conexion->Execute($consulta,array($cod,$desc,$familia,$med,$tipom,$talle,$color,$aroma,$costo,$sugerido));

        $sql_id = "SELECT @@identity AS id";

        $resp = $conexion->Execute($sql_id);
        
        $idp =  $resp->fields['id'];

        $sql2 = "INSERT INTO stock (id,producto_id,cantidad,punto_reposicion)
                 VALUES (NULL,?,?,?)";

        $consulta2 = $conexion->Prepare($sql2);

        $conexion->Execute($consulta2,array($idp,$stock,$repo));
 
        
         $conexion->completeTrans();
    
         return $consulta;
         
    }
    
    function modificarProdStock()
    {

        $id =  $this->_id;
        $cod = $this->_codigo;
        $desc = $this->_descipcion;
        $familia = $this->_familia_id;
        $med = $this->_medida;
        $tipom = $this->_tipo_medida_id;
        $talle = $this->_talle;
        $color = $this->_color;
        $aroma = $this->_aroma;
        $costo = $this->_precio_costo;
        $sugerido = $this->_precio_sugerido;
        $repo = $this->_punto_reposicion;
        $stock = $this->_stock;
                

        

        $conexion = Database::DB();

         $conexion->startTrans();
            ///
         $sql = "UPDATE producto SET codigo = ?, descripcion = ?, familia_id = ?, medida = ?, medida_id = ?, talles = ?,color = ?, aromas = ?, costo = ?, sugerido = ?
                WHERE id = ?";

         $consulta = $conexion->Prepare($sql);

         $conexion->Execute($consulta,array($cod,$desc,$familia,$med,$tipom,$talle,$color,$aroma,$costo,$sugerido,$id));
            ///
          $sql2 = "UPDATE stock SET cantidad = ?, punto_reposicion = ? WHERE producto_id = ?";

          $consulta2 = $conexion->Prepare($sql2);

          $conexion->Execute($consulta2,array($stock,$repo,$id));
        
         $conexion->completeTrans();
    
		 return $consulta;
    }

    function deleteProdStock()
    {

        $id =  $this->_id;

        $conexion = Database::DB();

         $conexion->startTrans();
            ///
         $sql = "UPDATE producto SET activo = 'N'
                WHERE id = ?";

         $consulta = $conexion->Prepare($sql);

         $conexion->Execute($consulta,array($id));

            ///
         $conexion->completeTrans();
    
		 return $consulta;
    }

    function modificar()
    {

        $id =  $this->_id;
        $cod = $this->_codigo;
        $desc = $this->_descipcion;
        $familia = $this->_familia_id;
        $med = $this->_medida;
        $tipom = $this->_tipo_medida_id;
        $talle = $this->_talle;
        $color = $this->_color;
        $aroma = $this->_aroma;
        $costo = $this->_precio_costo;
        $sugerido = $this->_precio_sugerido;
                

        

        $conexion = Database::DB();

         $conexion->startTrans();
            ///
         $sql = "UPDATE producto SET codigo = ?, descripcion = ?, familia_id = ?, medida = ?, medida_id = ?, talles = ?,color = ?, aromas = ?, costo = ?, sugerido = ?
                WHERE id = ?";

         $consulta = $conexion->Prepare($sql);

         $conexion->Execute($consulta,array($cod,$desc,$familia,$med,$tipom,$talle,$color,$aroma,$costo,$sugerido,$id));
            ///
        //  $sql2 = "UPDATE precio_prod SET costo = ?, sugerido = ?, fecha = NOW() WHERE producto_id = ?";

        //  $consulta2 = $conexion->Prepare($sql2);

        //  $conexion->Execute($consulta2,array($costo,$sugerido,$id));
        
         $conexion->completeTrans();
    
		 return $consulta;
    }


    function obtenerProductoAll()
    { 
        
        $conexion = Database::DB();
        $sql = "SELECT * FROM productos_vw WHERE (cantidad > 0 OR cantidad IS null)";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }
    

    function obtenerProductoStockAll()
    {
        
        $conexion = Database::DB();
        $sql = "SELECT * FROM productos_stock_vw WHERE stock > 0 ";

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }
    
    function obtenerProductoSinStockAll()
    {
        
        $conexion = Database::DB();
        $sql = "SELECT * FROM productos_stock_vw WHERE stock <= 0 ";

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerProductoAll2()
    {
        
        $lista = $this->_fecha_alta;
        $conexion = Database::DB();
        $sql = "SELECT P.ID,P.CODIGO,P.DESCRIPCION,P.FAMILIA_ID,P.MEDIDA,P.MEDIDA_ID AS MEDIDA_DESC,P.TALLES,P.COLOR,P.AROMAS,
                FP.DESCRIPCION AS FAMILIA, FP.PORC_SUGERIDO AS POR_SUG_FAMILIA,
                round(P.COSTO) AS PRECIO_COSTO,round(P.SUGERIDO) AS PRECIO_SUGERIDO, P.fecha_alta
                FROM producto P
                INNER JOIN familia_producto FP ON (P.FAMILIA_ID = FP.ID)
                WHERE fecha_alta = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($lista));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }
    
    function obtenerListas()
    {
        
        $conexion = Database::DB();
        $sql = "SELECT distinct fecha_alta, DATE_FORMAT(fecha_alta, '%M %Y') AS fecha FROM producto WHERE fecha_alta <> '0000-00-00'";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerListas2()
    {
        
        $conexion = Database::DB();
        $sql = "SELECT distinct fecha_alta, DATE_FORMAT(fecha_alta, '%M %Y') AS fecha FROM producto where activo = 'N' ";

       // $consulta = $this->conexion->Prepare($sql);

        $consulta = $conexion->Execute($sql);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerProductoAllFamilias()
    {
        $familia = $this->_familia_id;
        $fecha = $this->_fecha_alta;

        $conexion = Database::DB();

        // $sql = "SELECT ID,CODIGO,DESCRIPCION,FAMILIA_ID,MEDIDA,MEDIDA_DESC,TALLES,COLOR,AROMAS,FAMILIA,POR_SUG_FAMILIA,PRECIO_COSTO,PRECIO_SUGERIDO
        //  FROM productos_vw p WHERE p.FAMILIA_ID = ? and p.fecha_alta = ? ";
        $sql = "SELECT P.ID,P.CODIGO,P.DESCRIPCION,P.FAMILIA_ID,P.MEDIDA,P.MEDIDA_ID AS MEDIDA_DESC,P.TALLES,P.COLOR,P.AROMAS,
                FP.DESCRIPCION AS FAMILIA, FP.PORC_SUGERIDO AS POR_SUG_FAMILIA,
                round(P.COSTO) AS PRECIO_COSTO,round(P.SUGERIDO) AS PRECIO_SUGERIDO, P.fecha_alta
                FROM producto P
                INNER JOIN familia_producto FP ON (P.FAMILIA_ID = FP.ID)
                WHERE P.FAMILIA_ID = ? and P.fecha_alta = ?";

       $consulta = $conexion->Prepare($sql);

       $consulta = $conexion->Execute($consulta,array($familia,$fecha));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerProductoId()
    {
        $idp = $this->_id;

        $conexion = Database::DB();

        $sql = "SELECT *
                FROM productos_all_vw
                WHERE id = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($idp));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }
    
    function obtenerProductoIdStock()
    {
        $idp = $this->_id;

        $conexion = Database::DB();

        $sql = "SELECT *
                FROM productos_stock_vw
                WHERE id = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($idp));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerProductosIdPedido()
    {
        $idp = $this->_idpedido;

        $conexion = Database::DB();

        $sql = "SELECT dp.cantidad,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,m.descripcion AS tipomedida,dp.talle_prod,t.descripcion AS talle,dp.color_prod,c.descripcion AS color,dp.aroma_prod,a.descripcion AS aroma,p.* 
        FROM pedido_detalle dp
        INNER JOIN productos_all_vw p ON (dp.producto_id = p.id)
        LEFT JOIN medidas m ON (dp.tipo_medida_prod = m.id)
        LEFT JOIN talles t ON (dp.talle_prod = t.id)
        LEFT JOIN colores c ON (dp.color_prod = c.id)
        LEFT JOIN aromas a ON (dp.aroma_prod = a.id)
        WHERE dp.pedido_id = ?";

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($idp));
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerProductosPedidos()
    {
  
        $conexion = Database::DB();

        $sql = "SELECT SUM(dp.cantidad) AS cantidad,dp.producto_id,dp.cantidad AS cant_prod,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,dp.talle_prod,dp.color_prod,dp.aroma_prod,
                p.DESCRIPCION,p.FAMILIA,
                m.descripcion AS tipomedida,t.descripcion AS talle,c.descripcion AS color,a.descripcion AS aroma, cli.nro_cliente
                FROM pedido_detalle dp
                INNER JOIN pedido pe ON (dp.pedido_id = pe.id)
                INNER JOIN cliente cli ON (pe.cliente_id = cli.id)
                INNER JOIN productos_all_vw p ON (dp.producto_id = p.id)
                LEFT JOIN medidas m ON (dp.tipo_medida_prod = m.id)
                LEFT JOIN talles t ON (dp.talle_prod = t.id)
                LEFT JOIN colores c ON (dp.color_prod = c.id)
                LEFT JOIN aromas a ON (dp.aroma_prod = a.id)
                WHERE pe.estado_id = 9 AND pe.activo = 'S' AND p.FECHA_ALTA <> '0000-00-00'
                GROUP BY dp.producto_id,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,dp.talle_prod,dp.color_prod,dp.aroma_prod,
                p.DESCRIPCION,p.FAMILIA,
                m.descripcion,t.descripcion,c.descripcion,a.descripcion"; 

       $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta);
      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }

    function obtenerProductosPedidosTodos()
    {
        $est = $this->_estado_pedido;
        $conexion = Database::DB();

        if($est == 'default'){

            $sql = "SELECT SUM(dp.cantidad) AS cantidad,dp.producto_id,dp.cantidad AS cant_prod,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,dp.talle_prod,dp.color_prod,dp.aroma_prod,
                    p.DESCRIPCION,p.FAMILIA,
                    m.descripcion AS tipomedida,t.descripcion AS talle,c.descripcion AS color,a.descripcion AS aroma,pe.estado_id,ep.descripcion AS estado
                    FROM pedido_detalle dp
                    INNER JOIN pedido pe ON (dp.pedido_id = pe.id)
                    INNER JOIN estado_pedido ep ON (pe.estado_id = ep.id)
                    INNER JOIN productos_all_vw p ON (dp.producto_id = p.id)
                    LEFT JOIN medidas m ON (dp.tipo_medida_prod = m.id)
                    LEFT JOIN talles t ON (dp.talle_prod = t.id)
                    LEFT JOIN colores c ON (dp.color_prod = c.id)
                    LEFT JOIN aromas a ON (dp.aroma_prod = a.id)
                    WHERE pe.activo = 'S'
                    GROUP BY dp.producto_id,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,dp.talle_prod,dp.color_prod,dp.aroma_prod,
                    p.DESCRIPCION,p.FAMILIA,
                    m.descripcion,t.descripcion,c.descripcion,a.descripcion";
        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta);

        }else{

            $sql = "SELECT SUM(dp.cantidad) AS cantidad,dp.producto_id,dp.cantidad AS cant_prod,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,dp.talle_prod,dp.color_prod,dp.aroma_prod,
                    p.DESCRIPCION,p.FAMILIA,
                    m.descripcion AS tipomedida,t.descripcion AS talle,c.descripcion AS color,a.descripcion AS aroma,pe.estado_id,ep.descripcion AS estado
                    FROM pedido_detalle dp
                    INNER JOIN pedido pe ON (dp.pedido_id = pe.id)
                    INNER JOIN estado_pedido ep ON (pe.estado_id = ep.id)
                    INNER JOIN productos_all_vw p ON (dp.producto_id = p.id)
                    LEFT JOIN medidas m ON (dp.tipo_medida_prod = m.id)
                    LEFT JOIN talles t ON (dp.talle_prod = t.id)
                    LEFT JOIN colores c ON (dp.color_prod = c.id)
                    LEFT JOIN aromas a ON (dp.aroma_prod = a.id)
                    WHERE pe.estado_id = ? AND pe.activo = 'S'
                    GROUP BY dp.producto_id,dp.llego,dp.codigo_prod,dp.medida_prod,dp.tipo_medida_prod,dp.talle_prod,dp.color_prod,dp.aroma_prod,
                    p.DESCRIPCION,p.FAMILIA,
                    m.descripcion,t.descripcion,c.descripcion,a.descripcion";
        $consulta = $conexion->Prepare($sql);

        $consulta = $conexion->Execute($consulta,array($est));

        }
        

      
        $resultado = array();
		while ($r = $consulta->fetchRow())
			$resultado[] = $r;

		   return $resultado;
    }
    

    


}
