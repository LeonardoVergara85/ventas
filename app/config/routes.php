<?php

/**
 * Home con autenticación
 */
$router->get('/', function () {
  $vista = new \Core\View('home');
  return $vista->render();
}, ['middleware' => 'auth']);

/**
 * Datos Base
 */
$router->get('/base', 'DatoBaseController@inicio', ['middleware' => 'auth']);
$router->post('/base/listado', 'DatoBaseController@listado');
$router->post('/base/autocomplete', 'DatoBaseController@autocompletar', ['middleware' => 'auth']);
$router->post('/base/alta', 'DatoBaseController@alta', ['middleware' => 'auth']);
$router->post('/base/baja', 'DatoBaseController@baja', ['middleware' => 'auth']);
$router->post('/base/modificar', 'DatoBaseController@modificar', ['middleware' => 'auth']);

/**
 * Atuenticación
 */
$router->get('/login', 'AuthController@login');
$router->get('/home', 'AuthController@home');
$router->get('/logout', 'AuthController@logout');
$router->post('/auth', 'AuthController@auth');
$router->get('/auth/token', 'AuthController@getToken');



/**
 * Varias
 */
$router->get('/crypt', function () {
  $request = new \Core\Request();
  $tabla = $request->tabla;
  $titulo = $request->titulo;
  $key = "epmnJ8nJ/TkpJwuHHfofktybjGqsgrWInnB1yT6KIMo=";
  echo "<strong>Llave</strong>: $key <br><br>";
  echo "/base?titulo=" . urlencode(encrypt($titulo, $_ENV['MENU_KEY'])) . "&tabla=" . urlencode(encrypt($tabla, $_ENV['MENU_KEY']));
});

$router->get('/crypt/key', function(){
  echo base64_encode(openssl_random_pseudo_bytes(32));
});

// -- RUTAS -- //
// -- PRODUCTOS -- //
$router->post('/prod/listado', 'ProductoController@listado');
$router->post('/prod/listado_pedido', 'ProductoController@listadoPedido');
$router->post('/prod/listado_pedido_2', 'ProductoController@listadoPedido2');
$router->post('/prod/buscar_id', 'ProductoController@obtenerProducto');
$router->post('/prod/familias', 'ProductoController@obtenerFamilias');
$router->post('/prod/modifcar', 'ProductoController@modificar');
$router->post('/prod/buscar_familia', 'ProductoController@listadoXFamilias');
$router->post('/prod/listas', 'ProductoController@listasprod');
$router->post('/prod/listas2', 'ProductoController@listasprod2');


// -- PRODUCTOS STOCK -- //
$router->post('/prod_stock/listado', 'ProductoController@listadostock');
$router->post('/prod/buscar_stock_id', 'ProductoController@obtenerProductoStock');
$router->post('/prod/alta_stock', 'ProductoController@altaProductoStock');
$router->post('/prod/modifcar_stock', 'ProductoController@modificarProductoStock');
$router->post('/prod/delete_prod_stock', 'ProductoController@deleteProductoStock');
$router->post('/prod/renovar_prod_stock', 'ProductoController@renovarProductoStock');
$router->post('/prod_stock/listado_sin_stock', 'ProductoController@listadoSinstock');
$router->post('/prod_stock/listado_eliminados', 'ProductoController@listadoEliminados');

// -- CLIENTES -- //
$router->post('/cli/listado', 'ClienteController@listado');
$router->post('/cli/listado_autocompletar', 'ClienteController@listadoParaAutocompletar');
$router->post('/cli/buscar_id', 'ClienteController@obtenerCliente');
$router->post('/cli/buscar_id_pdf', 'ClienteController@obtenerCliente');
$router->post('/cli/guardar', 'ClienteController@guardar');
$router->post('/cli/modificar', 'ClienteController@modificar');

// -- PEDIDO -- //
$router->post('/pedido/guardar', 'PedidoController@guardarPedido');
$router->post('/pedido/modificar', 'PedidoController@modificarPedido');
$router->post('/pedido/listado', 'PedidoController@listadoPedidos');
$router->post('/pedido/id', 'PedidoController@pedidoId');
$router->post('/pedido/productosid', 'PedidoController@productosPedidoId');
$router->post('/pedido/productospedidos', 'PedidoController@productosPedidos');
$router->post('/pedido/productospedidos_todos', 'PedidoController@productosPedidosTodos');
$router->post('/pedido/listado_estados', 'PedidoController@listadoEstado');
$router->post('/pedido/listado_estados_all', 'PedidoController@listadoEstadoAll');
$router->post('/pedido/mod_estado', 'PedidoController@cambiarEstadoPedido');
$router->post('/pedido/eliminar', 'PedidoController@eliminarPedido');

$router->post('/pedido/medidas', 'PedidoController@listadoMedidas');
$router->post('/pedido/talles', 'PedidoController@listadoTalles');
$router->post('/pedido/colores', 'PedidoController@listadoColores');
$router->post('/pedido/aromas', 'PedidoController@listadoAromas');

// -- Localidad -- //
$router->post('/cli/localidades', 'ClienteController@listadoLocalidades');

// -- formas de envio -- //
$router->post('/fe/listado', 'PedidoController@listadoFormadeEnvio');

// -- formas de envio -- //
$router->post('/fp/listado', 'PedidoController@listadoFormadePago');

// -- Usuarios -- //
$router->post('/usu/listado', 'UsuarioController@listado');



// -- redireccionar a vistas -- //
// -- los utilizamos para el menú de navegación --//
$router->get('/productos', function () { $vista = new \Core\View('productos');
  return $vista->render();
});
$router->get('/productos_stock', function () { $vista = new \Core\View('productos_stock');
  return $vista->render();
});
$router->get('/productos_pedidos', function () { $vista = new \Core\View('productos_pedidos');
  return $vista->render();
});
$router->get('/productos_pedidos_todos', function () { $vista = new \Core\View('productos_pedidos_todos');
  return $vista->render();
});
$router->get('/pedidos', function () { $vista = new \Core\View('pedidos');
  return $vista->render();
});
$router->get('/clientes', function () { $vista = new \Core\View('clientes');
  return $vista->render();
});
$router->get('/usuarios', function () { $vista = new \Core\View('usuarios');
  return $vista->render();
});
$router->get('/troquel', function () { $vista = new \Core\View('troquel_pdf');
  return $vista->render();
});
$router->get('/prueba/token', function () { 
  echo "Pasó validación por TOKEN";
}, ['middleware' => 'jwt']);
