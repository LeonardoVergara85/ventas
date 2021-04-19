<?php $this->layout('layout/app', ['titulo' => 'Clientes']) ?>
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
.contador {
    /* float: right; */
    color: #555555;
    font-style: italic;
}

    </style>
<div class="container-fluid" style="margin-top:10px;">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary" id="nuevo_cliente">
	<i class="fa fa-user-plus" aria-hidden="true"></i>
		Nuevo
	</button>
	<div class="form-group col-md-12 text-center" id='divsearchicon' style="z-index: 100;position: absolute;margin-bottom: 20px;">
				<strong>Cargando... </strong> 
				<div class="spinner-border text-primary" role="status" id='searchicon'>
					<span class="sr-only">Loading...</span>
				</div>
		</div>
 <div class="card" style="margin-top:10px;">
    <div class="card-header">
        Clientes
    </div>
    <div class="card-body">
    <div class="col-sm-12" id="divTable">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display nowrap" style="width:100%" id="table_clientes">
					<thead>
						<th>Nro</th>
						<th>Nombre</th>
						<th>Dni</th>
						<th>Fecha nac.</th>
						<th>Localidad</th>
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

 <!-- Modal modificar -->
<div class="modal fade" id="modal_cliente">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle del cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		<form id="form_mod_cliente">
			  <input type="hidden" class="form-control input-modal" id="identificador">
				<div class="form-group">
					<label>Nro. cliente</label>
					<input type="text" class="form-control input-modal campos-edit" id="nro_form" name="nro_form">
				</div>
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" class="form-control input-modal campos-edit" id="nom_form" name="nom_form">
				</div>
				<div class="form-group">
					<label>Apellido</label>
					<input type="text" class="form-control input-modal campos-edit" id="ape_form" name="ape_form">
				</div>
				<div class="form-group">
				
					<label>Dni</label>
					   <input type="text" class="form-control input-modal campos-edit" id="dni_form" name="dni_form">
				</div>
                <div class="form-group">
				
					<label>Nacimiento</label>
					   <input type="date" class="form-control input-modal campos-edit" id="nac_form" name="nac_form">
				</div>
				<div class="form-group">

					<label>Domicilio</label>
					   <input type="text" class="form-control campos_alta campos-edit" id="dom_form" name="dom_form">
				</div>
				<div class="form-group">	
					<label>Localidad</label>
					<select id="loc_form" name="loc_form" class="custom-select form-control campos-edit">
						<option value="default" selected>Seleccionar...</option>
					</select>
				</div>
				<div class="form-group">
					<label>Telefono</label>
					   <input type="text" class="form-control campos_alta" id="telefono_form" name="telefono_form">
				</div>
				<div class="form-group">
					<label>Correo</label>
					   <input type="text" class="form-control campos-edit" id="correo_form" name="correo_form">
				</div>

				<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Modificar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
      </div>
    </div>
  </div>
</div>
<!-- End Modal modificar -->

 <!-- Modal alta -->
 <div class="modal fade" id="modal_alta_cliente">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		<form id="form_nuevo_cliente">
				<div class="form-group">
					<label>Nro. cliente</label>
					<input type="number" class="form-control campos_alta" id="nro_form_add" name="nro_form_add">
				</div>
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" class="form-control campos_alta" id="nom_form_add" name="nom_form_add">
				</div>
				<div class="form-group">
					<label>Apellido</label>
					<input type="text" class="form-control campos_alta" id="ape_form_add" name="ape_form_add">
				</div>
				<div class="form-group">
				
					<label>Dni</label>
					   <input type="number" class="form-control campos_alta" id="dni_form_add" name="dni_form_add">
				</div>
                <div class="form-group">
				
					<label>Nacimiento</label>
					   <input type="date" class="form-control campos_alta" id="nac_form_add" name="nac_form_add">
				</div>
				<div class="form-group">

					<label>Domicilio</label>
					   <input type="text" class="form-control campos_alta" id="dom_form_add" name="dom_form_add">
				</div>

				<div class="form-group">	
					<label>Localidad</label>
					<select id="loc_form_add" name="loc_form_add" class="custom-select form-control campos_alta">
						<option value="default" selected>Seleccionar...</option>
					</select>
				</div>
				<div class="form-group">
					<label>Telefono</label>
					   <input type="text" class="form-control campos_alta" id="telefono_form_add" name="telefono_form_add">
				</div>
				<div class="form-group">
					<label>Correo</label>
					   <input type="text" class="form-control campos_alta" id="correo_form_add" name="correo_form_add">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Guardar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</form>
      </div>
      
    </div>
  </div>
</div>
<!-- End Modal alta-->

<!-- The Modal -->
<div class="modal fade" id="myModalTroquel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id='title-troquel'></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
		<form id="form_troquel_cliente">
			  <input type="hidden" class="form-control input-modal" id="identificador">
			  <div class="form-group" id="nombre-troquel">
				</div>
				<div class="form-group">
					<label>Saldo:</label>
					<input type="text" class="form-control input-modal" id="saldo_form" name="saldo_form">
				</div>
				<div class="form-group">
					<label>Observaciones:</label> <span class="contador" id="contadorc">100 caracteres</span>
					<textarea class="form-control rounded-0" id="observacion_form" rows="2" maxlength="100"></textarea>
				</div>
		</form>		
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer" id="foot">
		<form action='app/views/troquel_pdf.php' id='form-pfd'  method='post' target='myActionWin' style='margin-left: 93px;margin-top: -38.5px;'>
            <input type='hidden' name='nro'id="nro" value=''>
            <input type='hidden' name='localidad' id="localidad" value=''>
            <input type='hidden' name='nombre' id="nombre" value=''>
            <input type='hidden' name='apellido' id="apellido" value=''>
            <input type='hidden' name='telefono' id="telefono" value=''>
            <input type='hidden' name='domicilio' id="domicilio" value=''>
            <input type='hidden' name='saldo' id='saldo' value=''>
            <input type='hidden' name='observacion' id='observacion' value=''>
            <button type='button' class='btn btn-primary' id='pdftroquel' title='Troquel de datos' style="margin-top:38px;">Visualizar</button>
		</form>	
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
 <!-- END Modal -->

</div>




    

<?php $this->stop() ?>

<?php $this->start('scripts') ?>
  <script src="<?= asset('js/general.js') ?>"></script>
  <script src="<?= asset('js/clientes.js') ?>"></script>
<?php $this->stop() ?>
