<?php $this->layout('layout/app', ['titulo' => 'Productos/Stock']) ?>
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

<br>

<!-- <div class="container-fluid">
<form id="form-familias">
<div class="form-row">
	
		<div class="form-group col-md-6">
			<label class="">Familias</label>
			<select class="form-control inp-form" id="familias" name="familias">
			  <option value='default'>Seleccionar..</option>
			</select>
		</div>
		<div class="form-group col-md-2">
			<label class="">Listas</label>
			<select class="form-control inp-form" id="listas" name="listas">
			  <option value='default'>Seleccionar..</option>
			</select>
		</div>
		<div class="form-group col-md-2">
			<button type="submit" class="btn btn-primary" style="margin-top:32px;">Buscar</button> 
		</div>
		<div class="form-group col-md-2" id='divsearchicon' style='display:none;'>
				<strong>Buscando</strong> 
				<div class="spinner-border text-primary" role="status" style='display:none;' id='searchicon'>
					<span class="sr-only">Loading...</span>
				</div>
		</div>
	</form>	
	
 </div>  -->

 <div class="container-fluid">
    	<!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" id="nuevo-prod">
            Nuevo
        </button>
 </div>
<br>  
<div class="card ">
    <div class="card-header"> 
        <ul class="nav nav-tabs card-header-tabs pull-right"  id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="prod-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="color: #495057;">Productos con Stock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="prod-sin-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="color: #495057;">Productos sin Stock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="prod-eli-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" style="color: #495057;">Eliminados</a>
            </li>
        </ul>
    </div>

    <div class="card-body">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			
	<div class="col-sm-12" id="divTable">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display nowrap" style="width:100%" id="table_productos_stock">
					<thead>
						<th>codigo</th>
						<th>descripcion</th>
						<th>Medida</th>
						<th>Aroma</th>
						<th>Talle</th>
						<th>Color</th>
						<th>Familia</th>
						<th>Costo</th>
						<th>Sugerido</th>
						<th>stock</th>
						<th></th>
					</thead>
					<tbody>
					</tbody>
				</table>	
			</li>
		</ul>
	</div>
  
			</div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	<div class="col-sm-12" id="divTable">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display nowrap" style="width:100%" id="table_productos_sin_stock">
					<thead>
						<th>codigo</th>
						<th>descripcion</th>
						<th>Medida</th>
						<th>Aroma</th>
						<th>Talle</th>
						<th>Color</th>
						<th>Familia</th>
						<th>Costo</th>
						<th>Sugerido</th>
						<th>stock</th>
						<th></th>
					</thead>
					<tbody>
					</tbody>
				</table>	
			</li>
		</ul>
	</div>		
	</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
			   Eliminados En desarrollo...
			</div>
        </div>
    </div>
</div>  


 <!-- Modal -->
<div class="modal fade" id="modal_producto"  data-backdrop="static" data-keyboard="false" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitleProd"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  		<form id="form_producto_stock">
			  <input type="hidden" id="id_producto" name="id_producto">
			  <input type="hidden" id="tipo_accion" name="tipo_accion">
				<div class="form-group">
					<label>Código</label>
					<input type="text" class="form-control input-modal inp-form" id="codigo_form" name="codigo_form" maxlength='49' placeholder="ej: 100,E200R..">
				</div>
				<div class="form-group">
					<label>Descripción</label>
					<input type="text" class="form-control input-modal inp-form" id="desc_form" name="desc_form" maxlength='199' >
				</div>
				<div class="form-group">
					<label>Familia</label>
					<select class="form-control input-modal inp-form inp-form" id="familia_form" name="familia_form">
					</select>
				</div>
				<div class="form-group">
				
					<label>Medida</label>
					   <input type="text" class="form-control input-modal inp-form" id="med_form" name="med_form" placeholder="ej: 1,23,60..">
				</div>
				<div class="form-group">	
					<label>Tipo medida</label>
						<input type="text" class="form-control input-modal inp-form" id="med_tipo_form" name="med_tipo_form" placeholder="ej: cm,mts,m2..">
				</div>

			
				<div class="form-group">
					<label>talle</label>
					<input type="text" class="form-control input-modal inp-form" id="talle_form" name="talle_form" maxlength='99' placeholder="ej: XL,43,100..">
				</div>
				<div class="form-group">
					<label>Color</label>
					<input type="text" class="form-control input-modal inp-form" id="color_form" name="color_form" maxlength='99' placeholder="ej: verde,rosa..">
				</div>
				<div class="form-group">
					<label>Aroma</label>
					<input type="text" class="form-control input-modal inp-form" id="aroma_form" name="aroma_form" maxlength = '99'placeholder="ej: lavanda,limón..">
				</div>
				<div class="form-group">
					<label>Costo $</label>
					<input type="text" class="form-control input-modal inp-form" id="costo_form" name="costo_form">
				</div>
				<div class="form-group">
					<label>Sugerido $</label>
					<input type="text" class="form-control input-modal inp-form" id="sugerido_form" name="sugerido_form">
				</div>
                <div class="form-group">
					<label>Punto reposición</label>
					<input type="number" class="form-control input-modal inp-form" id="reposicion_form" name="reposicion_form">
				</div>
                <div class="form-group">
					<label>Stock</label>
					<input type="number" class="form-control input-modal inp-form" id="stock_form" name="stock_form">
				</div>
			
      </div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" id="accion-modal">Modificar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>
	  </form>
    </div>
  </div>
</div>
</div>

 <!-- The Modal eliminar -->
 <div class="modal fade" id="myModalDelete" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id='titleModalTitle_delete'></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			  <input type="hidden" class="form-control input-modal" id="producto_id_eliminar">
			  <div class="form-group" id="nombreModalEstado_delete">
				</div>
				<div class="form-group">
					<p class="text-danger">Desea eliminar el producto?</p>
				</div>
			
        </div>
        <!-- Modal footer -->
        <div class="modal-footer" id="foot">

            <button type='button' class='btn btn-danger' id="eliminar_producto">Eliminar</button>
		
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 <!-- END Modal eliminar --> 


    

<?php $this->stop() ?>

<?php $this->start('scripts') ?>
  <script src="<?= asset('js/general.js') ?>"></script>
  <script src="<?= asset('js/productos_stock.js') ?>"></script>
<?php $this->stop() ?>
