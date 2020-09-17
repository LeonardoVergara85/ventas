<?php $this->layout('layout/app', ['titulo' => 'Inicio']) ?>
<?php $this->start('estilos') ?>
<?php $this->stop() ?>
<?php $this->start('contenido') ?>

<?php 
  // $pass = $_POST['password'];    
  // $pass = '123456';    
  // $pass2 = '1234567';    
  //  $passHash = password_hash($pass, PASSWORD_BCRYPT);
  //  echo 'hash '.$passHash;

  //var_dump(password_verify($pass2, $passHash));
 //echo password_hash('Jeza2020', PASSWORD_BCRYPT);
?>


<?php $this->stop() ?>

<?php $this->start('scripts') ?>
  <script src="<?= asset('js/general.js') ?>"></script>
  <script src="<?= asset('js/home.js') ?>"></script>
<?php $this->stop() ?>

