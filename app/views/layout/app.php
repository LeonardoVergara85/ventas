<!DOCTYPE html>
<html lang="es">

<head>

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

	<title><?= $this->e($titulo) ?></title>
	<meta charset="utf-8" />
	<!-- BootsTrap CSS -->
	<link href="<?= lib('libs/js/bootstrap-4.3.1-dist/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

	<!-- DataTable CSS -->
	<link href="<?= lib('libs/js/DataTables-1.10.12/media/css/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= lib('libs/js/DataTables-1.10.12/extensions/ColReorder/css/colReorder.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/css/buttons.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />

	<!-- Font Awesomw CSS -->
	<link href="<?= lib('libs/js/Font-Awesome-master/web-fonts-with-css/css/fontawesome-all.css') ?>" rel="stylesheet" type="text/css" />

	<!-- TOASTR CSS -->
	<link href="<?= lib('libs/js/toastr/toastr.min.css') ?>" rel="stylesheet" type="text/css" />


    <!-- dataTable Responsive CSS -->
	<link href="<?= lib('libs/js/DataTables-1.10.12/extensions/Responsive/css/responsive.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= lib('libs/js/DataTables-1.10.12/extensions/FixedHeader/css/fixedHeader.dataTables.min.css') ?>" rel="stylesheet" type="text/css" />

 	<!-- JUERY UI  autocomplete CSS -->
	<link href="<?= lib('libs/js/jquery-ui-1.12.1.custom/jquery-ui.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?= lib('libs/js/jquery-ui-1.12.1.custom/jquery-ui.theme.css') ?>" rel="stylesheet" type="text/css" />


	<!-- App CSS -->
	<link href="<?= asset('css/app.css') ?>" rel="stylesheet" type="text/css" />
	



	<?= $this->section('estilos') ?>

</head>

<body>

	<?php if(session()->get('logueado')): ?>
	<?php $this->insert('layout/menu') ?>
	<?= $this->section('contenido') ?>
	<?php $this->insert('layout/pie') ?>
	<?php else: ?>
	<?= $this->section('contenido') ?>
	<?php endif ?>
	
</body>

<!--JQuery JS-->
<script src="<?= lib('libs/js/jquery-3.4.1/jquery-3.4.1.min.js') ?>" type="text/javascript"></script>
<!--Popper JS-->
<script src="<?= lib('libs/js/popper.js/popper.min.js') ?>" type="text/javascript"></script>

<!--BootsTrap JS-->
<script src="<?= lib('libs/js/bootstrap-4.3.1-dist/js/bootstrap.min.js') ?>" type="text/javascript"></script>

<!--DataTable JS-->
<script src="<?= lib('libs/js/DataTables-1.10.12/media/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/ColReorder/js/dataTables.colReorder.min.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/js/dataTables.buttons.min.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/js/buttons.flash.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/ajax/JSZip-2.5.0/jszip.min.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/ajax/pdfmake-0.1.36/pdfmake.min.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/ajax/pdfmake-0.1.36/vfs_fonts.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/js/buttons.html5.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Buttons/js/buttons.print.js') ?>" type="text/javascript"></script>


<!--dataTable Responsive JS-->
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/FixedHeader/js/dataTables.fixedHeader.min.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/DataTables-1.10.12/extensions/Responsive/js/dataTables.responsive.min.js') ?>" type="text/javascript"></script>

<!--Toastr JS-->
<script src="<?= lib('libs/js/toastr/toastr.min.js') ?>" type="text/javascript"></script>


<!--JQUERY Validate-->
<script src="<?= lib('libs/js/jquery-validation-1.19.0/dist/jquery.validate.min.js') ?>" type="text/javascript"></script>

<!--Editor-->
<!-- <script src="<?= lib('libs/js/editor.js') ?>" type="text/javascript"></script> -->

<!--autocomplete-->
<script src="<?= lib('libs/js/autocomplete.jquery.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/jquery-ui-1.12.1.custom/jquery-ui.js') ?>" type="text/javascript"></script>

<!-- InputMask JS-->
<script src="<?= lib('libs/js/jquery.inputmask-3.x/js/inputmask.js') ?>" type="text/javascript"></script>
<script src="<?= lib('libs/js/jquery.inputmask-3.x/dist/jquery.inputmask.bundle.js') ?>" type="text/javascript"></script>

<?= $this->section('scripts') ?>

</html>