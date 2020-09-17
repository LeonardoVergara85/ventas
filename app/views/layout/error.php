<?php $this->layout('layout/app', ['titulo' => 'Error']) ?>

<?php $this->start('contenido') ?>


<div class="container">
  <br>
  <br>
  <div class="row">
    <div class="col-md-12 offset-md-0 text-center">
      <div class="card">
        <div class="card-body">
          <div class="alert alert-danger" role="alert">
            <h3 class="alert-heading"> <i class="fas fa-exclamation-triangle"></i> Ha ocurrido un error!</h3>
            <?php if(strtolower($_ENV['APP_DEBUG']) === 'true'): ?>
            <p>CÓDIGO: <?= $error->code ?></p>
            <p>MENSAJE: <?= $error->message ?></p>
            <p>TRAZO:</p>
            <p><?= nl2br($error->trace) ?></p>
            <?php else: ?>
            <p>CÓDIGO: <?= $error->code ?></p>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->stop() ?>