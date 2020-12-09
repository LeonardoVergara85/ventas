<?php $this->layout('layout/app', ['titulo' => 'Pedidos']) ?>
<?php $this->start('estilos') ?>
<?php $this->stop() ?>
<?php $this->start('contenido') ?>

<style type="text/css" media="screen">
      .ui-autocomplete { 
       position: absolute;
       cursor: default;
       z-index:2147483647 !important;
       height: 200px;
       overflow-y: scroll;
       overflow-x: hidden;
     }
    </style>
    <style type="text/css" media="screen">
    div.dataTables_wrapper div.dataTables_filter {
      text-align: left;
      margin-top: 10px;
      float: left;
    }
    div.dt-buttons {

    position: relative;
    float: right;

}

</style>

<div class="container-fluid" style="margin-top:10px;">
<input type="hidden" id="usuario_id" value="<?php echo $_SESSION['usuario_id_2'];?>">

<div class="form-row">
	<div class="form-group col-md-1" id="divbtnnuevonormal">
		<button type="button" class="btn btn-primary" id="nuevo_pedido">
		<i class="fa fa-cart-plus" aria-hidden="true"></i>
		Nuevo
		</button>
	</div>
	<div class="form-group col-md-1" id="divbtnnuevolistas" style="display:none;margin-top: 32px;">
		<button type="button" class="btn btn-secondary" id="nuevo_pedido_2">
		<i class="fa fa-cart-plus" aria-hidden="true"></i>
		Nuevo
		</button>
	</div>
	<div class="form-group col-md-2" id="divlistas" style="display:none;">
		<label class="">Listas</label>
		<select class="form-control inp-form" id="listas" name="listas">
		<option value='default'>Seleccionar..</option>
		</select>
	</div>
	
</div>
<div class="form-row">
	<button type="button" class="btn btn-secondary btn-sm" id="btnlistavieja" value='0'>lista vieja</button>
</div>
<div class="form-group col-md-12 text-center" id='divsearchicon' style="z-index: 100;position: absolute;margin-bottom: 20px;">
	<strong>Cargando... </strong> 
	<div class="spinner-border text-primary" role="status" id='searchicon'>
		<span class="sr-only">Loading...</span>
	</div>
</div>
<br>

<div class="card ">
    <div class="card-header"> 
        <ul class="nav nav-tabs card-header-tabs pull-right"  id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pedidos-tab" data-toggle="tab" href="#pedidos" role="tab" aria-controls="home" aria-selected="true" style="color: #495057;">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="pedidos-finalizados" data-toggle="tab" href="#finalizados" role="tab" aria-controls="finalizados" aria-selected="false" style="color: #495057;">Pedidos finalizados</a>
            </li>
        </ul>
    </div>

    <div class="card-body">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="pedidos" role="tabpanel" aria-labelledby="pedidos-tab">
			
		<div class="col-sm-12" id="divTable">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display nowrap" style="width:100%" id="table_pedidos_general">
					<thead>
						<th>Id pedido</th>
						<th>Cliente</th>
						<th>Fecha Cierre</th>
						<th>Pago</th>
						<th>Envío</th>
						<th>Precio</th>
						<th>Estado</th>
						<th></th>
					</thead>
					<tbody>
					</tbody>
				</table>	
			</li>
		</ul>
	</div>
  
</div>
    <div class="tab-pane fade" id="finalizados" role="tabpanel" aria-labelledby="finalizados-tab">
	<div class="col-sm-12" id="divTable">
	<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display nowrap" style="width:100%" id="table_pedidos_finalizados">
					<thead>
						<th>Id pedido</th>
						<th>Cliente</th>
						<th>Fecha Cierre</th>
						<th>Pago</th>
						<th>Envío</th>
						<th>Precio</th>
						<th>Estado</th>
						<th></th>
					</thead>
					<tbody>
					</tbody>
				</table>	
			</li>
		</ul>
	</div>		
	</div>
        </div>
    </div>
 


 


 <!-- Modal -->
<div id="modal_pedido" class="modal fade" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle del producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		<form>
				<div class="form-group">
					<label>Código</label>
					<input type="text" class="form-control input-modal" id="codigo_form">
				</div>
				<div class="form-group">
					<label>Descripción</label>
					<input type="text" class="form-control input-modal" id="desc_form">
				</div>
				<div class="form-group">
					<label>Familia</label>
					<input type="text" class="form-control input-modal" id="familia_form">
				</div>
				<div class="form-group">
				
					<label>Medida</label>
					   <input type="text" class="form-control input-modal" id="med_form">
				</div>
				<div class="form-group">	
					<label>Tipo</label>
						<input type="text" class="form-control input-modal" id="med_tipo_form">
				</div>

			
				<div class="form-group">
					<label>talle</label>
					<input type="text" class="form-control input-modal" id="talle_form">
				</div>
				<div class="form-group">
					<label>Color</label>
					<input type="text" class="form-control input-modal" id="color_form">
				</div>
				<div class="form-group">
					<label>Aroma</label>
					<input type="text" class="form-control input-modal" id="aroma_form">
				</div>
				<div class="form-group">
					<label>Costo</label>
					<input type="text" class="form-control input-modal" id="costo_form">
				</div>
				<div class="form-group">
					<label>Sugerido</label>
					<input type="text" class="form-control input-modal" id="sugerido_form">
				</div>
			
				<button type="button" class="btn btn-primary">Modificar</button>
				<!-- <button type="submit" class="btn btn-primary">Modificar</button> -->
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModalPedido" data-backdrop="static" data-keyboard="false" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header" id = 'modal-header-tot'>
          <h4 class="modal-title" id = 'modal-title-alta'></h4>
          <p id='usuario-title' style="margin-top: 5px;margin-left: 60px;"></p>
		  <div id='form-btn-imp-pedido'>
		  <form action="app/views/pedido_pdf.php" id="form-pedidopfd"  method="post" target="myActionWin" style="margin-left: 93px;margin-top: -38.5px;">
			<input type="hidden" name="id_pdf" id="id_pdf" value="">
			<input type="hidden" name="cliente_pdf" id="cliente_pdf" value="">
			<input type="hidden" name="dni_pdf" id="dni_pdf" value="">
			<input type="hidden" name="fecha_pdf" id="fecha_pdf" value="">
			<input type="hidden" name="fechacierre_pdf" id="fechacierre_pdf" value="">
			<input type="hidden" name="nro_pdf" id="nro_pdf" value="">
			<input type="hidden" name="domicilio_pdf" id="domicilio_pdf" value="">
			<input type="hidden" name="localidad_pdf" id="localidad_pdf" value="">
			<input type="hidden" name="correo_pdf" id="correo_pdf" value="">
			<input type="hidden" name="telefono_pdf" id="telefono_pdf" value="">
			<input type="hidden" name="senia_pdf" id="senia_pdf" value="">
			<input type="hidden" name="saldo_pdf" id="saldo_pdf" value="">
			<input type="hidden" name="total_pdf" id="total_pdf" value="">
			<input type="hidden" name="descuento_pdf" id="descuento_pdf" value="">
			<input type="hidden" name="tipodescuento_pdf" id="tipodescuento_pdf" value="">
			<input type="hidden" name="arreglo_pdf" id="arreglo_pdf" value="">
			<button type="button" class="btn btn-secondary" id="pdfpedido" title="Troquel de datos" style="margin-top:38px;"><i class="fa fa-print" ></i> Imprimir</button>
		  </form>	
		  </div><div class="form-group col-md-2" id='divsearchicon' style='display:none;'>
				<strong>Cargando</strong> 
				<div class="spinner-grow text-primary" role="status" style='display:none;' id='searchicon'>
					<span class="sr-only">Loading...</span>
				</div>
		</div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
        </div>
        
        <!-- Modal body -->
		
        <div class="modal-body">
		<form id="alta_pedido">
		<input type="hidden" id="tipo_accion" value="">
		<input type="hidden" id="id_pedido" value="">
		<input type="hidden" id="cod2" value="1">
		    <div class="form-row">
				<div class="form-group col-md-3">
				    <label class="">Cliente</label>
                    <input type="text" class="form-control inp-form" id="cliente" name="cliente" placeholder="Escribir cliente">
                     <input type="hidden" id="cliente_id" name="cliente_id" >
				</div>
				<div class="form-group col-md-1" style="margin-top: 30px;" >
					 <button type="button" class="btn btn-outline-secondary" id="modificar-cli" style="display:none;">
					 <i class="far fa-edit"></i>
					 </button>
				</div>
				<div class="form-group col-md-8">
				    <label class="">Observación</label>
                    <input type="text" class="form-control inp-form" id="observacion" name="observacion" placeholder="Escribir una observación" maxlength='77'>
				</div>
				</div>
				<div class="form-row">
				<div class="form-group col-md-6">
				    <label class="">Producto</label>
                    <input type="text" class="form-control inp-form" id="producto" name="producto" placeholder="Escribir producto">
                     <input type="hidden" id="producto_id" name="producto_id" >
					 
				</div>
				<div class="form-group col-md-1" style="margin-top:30px;">
					<button type="button" class="btn btn-success btn-sx" id="add-producto" style="display:none;">
					<i class="far fa-plus-square"></i>
					</button>
				</div>
		    </div>
			<div class="form-row">
			<div class="form-group col-md-12">
			<table class="table table-hover" id="table-add-prod">
				<thead>
					<th style='display:none;'>id</th>
					<th>codigo</th>
					<th>Descripción</th>
					<th></th>
					<th>Medida</th>
					<th>Talle</th>
					<th>Color</th>
					<th>Aroma</th>
					<th>Costo</th>
					<th style='display:none;' id="cant-hidden"></th>
					<th>cantidad</th>
					<th>Total</th>
					<th>!</th>
					<th></th>
				</thead>
				<tbody>
				  
				</tbody>
			</table>
			</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
				 
				</div>
				<div class="input-group col-md-2">
					<div class="input-group-prepend">
						<span class="input-group-text">Seña $</span>
					</div>
					<input type="text" class="form-control text-center inp-form" id="senia_pedido" name="senia_pedido" value="0">
				</div>
				<div class="input-group col-md-2">
					<div class="input-group-prepend">
						<span class="input-group-text">Total $</span>
					</div>
					<input type="text" class="form-control text-center inp-form" id="total_pedido" name="total_pedido" value="0" disabled>
				</div>
				<div class="input-group col-md-2">
					<div class="input-group-prepend">
						<span class="input-group-text">Saldo $</span>
					</div>
					<input type="text" class="form-control text-center inp-form" id="saldo_pedido" name="saldo_pedido" value="0" disabled>
				</div>
			</div>
			<div id="div-pedido-2" style="">
			  <div class="form-row">
				<div class="form-group col-md-6">
				    <label class="">Forma de pago</label>
					<select class="form-control inp-form" id="tipo_pago" name="tipo_pago">
					<option value='default'>seleccionar..</option>
					</select>
				</div>
				<div class="form-group col-md-2">
				    <label class="">Tipo descuento</label>
					<select type="text" class="form-control inp-form" id="tipo_descuento_pedido" name="tipo_descuento_pedido" disabled>
					<option value='1' selected>%</option>
					<option value='2'>$</option>
					</select>
				</div>
				<div class="form-group col-md-2">
				    <label class="">Descuento</label>
					<select type="text" class="form-control inp-form" id="descuento_pedido_porc" name="descuento_pedido_porc" disabled>
					<option value='0' selected>seleccionar</option>
					<option value='5'>5%</option>
					<option value='10'>10%</option>
					<option value='15'>15%</option>
					<option value='20'>20%</option>
					<option value='25'>25%</option>
					<option value='30'>30%</option>
					<option value='35'>35%</option>
					<option value='40'>40%</option>
					<option value='45'>45%</option>
					<option value='50'>50%</option>
					</select>
					<input type="text" class="form-control inp-form" id="descuento_pedido_cant" name="descuento_pedido_cant" style="display:none;" placeholder="descuento">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
				    <label class="">Tipo de envío</label>
					<select class="form-control inp-form" id="tipo_envio" name="tipo_envio">
					<option value='default'>seleccionar..</option>
					</select>
				</div>
				
				<div class="form-group col-md-3">
					<label class="">Fecha de cierre</label>
				   <input type="date" class="form-control inp-form" id="fecha_cierre" name="fecha_cierre">
				</div>
			
				<div class="form-group col-md-3">

					
				
				</div>
				
		      </div>
			</div>	
			<!-- Modal footer -->
		    <div class="modal-footer">
				<button type="submit" class="btn btn-primary" id="btn-formulario">Guardar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				
			</div>
		</form>	
			
        </div>
        
        
        
      </div>
    </div>



  </div>


	<!-- The Modal -->
	<div class="modal fade" id="myModalEstados" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id='titleModalTitle'></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
		<form id="form_estado_cliente">
			  <input type="hidden" class="form-control input-modal" id="pedido_id">
			  <div class="form-group" id="nombreModalEstado">
				</div>
				<div class="form-group">
					<label>Estado</label>
					<select class="form-control input-modal"name="estado_id" id="estado_id">
					</select>
				</div>
			
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer" id="foot">

            <button type='submit' class='btn btn-primary'>Modificar</button>
		
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>	
      </div>
    </div>
  </div>
 <!-- END Modal --> 

 <!-- The Modal eliminar -->
 <div class="modal fade" id="myModalEliminar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id='titleModalTitle_eliminar'></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			  <input type="hidden" class="form-control input-modal" id="pedido_id_eliminar">
			  <div class="form-group" id="nombreModalEstado_eliminar">
				</div>
				<div class="form-group">
					<p class="text-danger">Desea eliminar el pedido?</p>
				</div>
			
        </div>
        <!-- Modal footer -->
        <div class="modal-footer" id="foot">

            <button type='button' class='btn btn-danger' id="eliminar_pedido">Eliminar</button>
		
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <!-- END Modal eliminar --> 

  <!-- The Modal deshabilitar -->
  <div class="modal fade" id="myModalDeshabilitar" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id='titleModalTitle_deshabilitar'></h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			  <input type="hidden" class="form-control input-modal" id="pedido_id_eliminar">
			  <div class="form-group" id="nombreModalEstado_eliminar">
				</div>
				<div class="form-group">
					<input type='hidden' id='tipoHabilitacion' value=''>
					<p class="text-secondary" id='msjModalHabilitar'></p>
				</div>
			
        </div>
        <!-- Modal footer -->
        <div class="modal-footer" id="foot">

            <button type='button' class='btn btn-danger' id="deshabilitar_producto" name="">Aceptar</button>
		
          <button type="button" class="btn btn-secondary" id="close-deshabilitar" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <!-- END Modal deshabilitar --> 

    

<?php $this->stop() ?>

<?php $this->start('scripts') ?>
  <script src="<?= asset('js/general.js') ?>"></script>
  <script src="<?= asset('js/pedidos.js') ?>"></script>
<?php $this->stop() ?>
