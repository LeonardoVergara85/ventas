<?php $this->layout('layout/app', ['titulo' => 'Productos-Pedidos todos']) ?>
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

<div class="container-fluid">
	<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Nuevo
</button> -->
<div class="form-row">
				<div class="form-group col-md-6">
				    <label class="">Estados de pedido</label>
					<select class="form-control inp-form" id="estados" name="estados">
					<option value='default'>Todo</option>
					</select>
				</div>
        <div class="form-group col-md-2">
          <button type="button" class="btn btn-primary" style="margin-top:32px;" id="buscardor">Buscar</button> 
        </div>
        <div class="form-group col-md-2" id='divsearchicon' style='display:none;'>
				<strong>Buscando</strong> 
				<div class="spinner-border text-primary" role="status" style='display:none;' id='searchicon'>
					<span class="sr-only">Loading...</span>
				</div>
		</div>
 </div>               
 <div class="card">
    <div class="card-header">
        <strong>Productos pedidos</strong>
    </div>
    <div class="card-body">
    <div class="col-sm-12" id="divTable">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display " style="width:100%" id="table_productos_pedidos">
					<thead>
						<th>codigo</th>
						<th>descripcion</th>
						<th>Medida</th>
						<th>Talle</th>
						<th>Color</th>
						<th>Aroma</th>
						<th>Familia</th>
						<th>Estado</th>
						<th>Cantidad</th>
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

<?php $this->stop() ?>

<?php $this->start('scripts') ?>
  <script src="<?= asset('js/general.js') ?>"></script>
  <script src="<?= asset('js/productos_pedidos_todos.js') ?>"></script>
<?php $this->stop() ?>
