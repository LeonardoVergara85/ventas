<?php
use Core\Clases\Request;

$this->layout('layout/app', ['titulo' => 'Información Inicial']) ?>

<?php $this->start('contenido') ?>

<div class="container">
  <h2><?= $this->e($titulo) ?></h2>
  <!-- Mensaje de error -->
  <div class="alert alert-danger" role="alert" style="display: none">
    <label id="lbl_msg"></label>
  </div>
  
  <!-- Contenido -->
  <br>
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDato">
    <i class="fas fa-plus"></i>
    AGREGAR 
  </button>
  <table id="tablaDatos">
    <thead>
      <th>ID</th>
      <th>DESCRIPCIÓN</th>
      <th>ACTIVO</th>
      <th>ACCIONES</th>
    </thead>
  </table>
</div>

<!-- Modals -->
  <div class="modal fade" id="modalDato" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form id="altaForm">
            <div class="form-group">
              <label for="descripcion">Descripción:</label>
              <input type="text" class="form-control" id="descripcion">
            </div>
            <div class="form-group">
              <label for="activo">Activo:</label>
              <select class="form-control" id="activo">
                <option value='S' selected>SI</option>
                <option value='N'>NO</option>
              </select>
            </div>
            <input type="hidden" class="form-control" id="tabla" value="<?= $tabla ?>">
            <div class="row float-right">
              <div class="col">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardar" class="btn btn-info"><i class="fas fa-save"></i> Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4>¿Seguro/a que desea eliminar este dato?</h4><br>
          <div class="row float-right">
            <div class="col">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" id="btnEliminarDato" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar</button>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $this->stop() ?>

<?php $this->start('scripts') ?>
<script src="<?= asset('js/datobase/DatoBase.js') ?>"></script>
<?php $this->stop() ?>
