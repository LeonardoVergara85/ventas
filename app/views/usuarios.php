<?php $this->layout('layout/app', ['titulo' => 'Usuarios']) ?>
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
	<!-- Button trigger modal -->
	<!-- <button type="button" class="btn btn-primary" id="nuevo_cliente">
	<i class="fa fa-user-plus" aria-hidden="true"></i>
		Nuevo
	</button> -->
 <div class="card" style="margin-top:10px;">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
    <div class="col-sm-12" id="divTable">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<table class="display nowrap" style="width:100%" id="table_usuarios">
					<thead>
						<th>Username</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Dni</th>
						<th>Tipo</th>
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
  <script src="<?= asset('js/usuarios.js') ?>"></script>
<?php $this->stop() ?>
