<?php $this->layout('layout/app', ['titulo' => 'Acceso denegado']) ?>

<?php $this->start('contenido') ?>


<div class="container">
    <br>
    <br>
    <div class="row">
      <div class="col-md-12 offset-md-0 text-center">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading">ACCESO DENEGADO!</h4>
              <p>Usted no tiene permisos para acceder a esta página.</p>
              <hr>
              <p class="mb-0">
                <i class="fas fa-exclamation-triangle fa-10x animated flash delay-0s"></i>
              </p>
            </div>
            <!--<div class="col-lg-12 text-center">
              <button type="button" id="volver_denied" class="btn btn-default" style="display: ''" onclick="window.location='home.php'">
                <i class="fas fa-arrow-left"></i>&nbsp;
                VOLVER
              </button>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->stop() ?>

