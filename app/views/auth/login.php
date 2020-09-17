<?php $this->layout('layout/app', ['titulo' => 'Conexión']) ?>
<?php $this->start('estilos') ?>
<?php $this->end() ?>
<?php $this->start('contenido') ?>

<div class="container-fluid text-center">
    <div class="row">    
        

        <div class="col-xs-12 col-ms-3 col-md-3 col-lg-3" style="padding-left: 0px;">
                <!-- IMAGEN  
                <img src="assets/img/inicio.png" class="img-fluid vh-100 wh-100">-->
       
            
                <!-- <picture>
                    <source srcset="assets/img/inicio2.png" media="(max-width: 768px)" class="img-fluid" >
                    <source srcset="assets/img/inicio.png" class="img-fluid">
                    <img srcset="assets/img/inicio.png" class="img-fluid vwh-100">
                </picture>  -->
  
   
        </div>          
        <!-- LOGIN --> 
        <div class="col-xs-12 col-ms-6 col-md-6 col-lg-6">         
                <div class="row abs-medio-login">
                            <div>
                            <div class="GrisExtraGrande">ACCESO AL SISTEMA</div>
                            <div class="alert alert-danger" role="alert" style="display: none">
                            <label id="lbl_msg"></label>
                            </div>
                            <br>

                            <form id="loginForm">
                                <input id="resultcaptcha" type="hidden" value="">
                                <div class="form-group">
                                    <input type="text" id="usuario" class="form-control border text-center" placeholder="USUARIO">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="contrasenia" class="form-control border text-center" placeholder="CONTRASEÑA">
                                </div> 
                                <br>                               
                                <div class="row" style="margin-left: 0px;">
                                    <form class="form" action="" id="form_capt">
                                    <input class="jCaptcha" id="aa" type="text" placeholder="Ingrese el resultado">
                                    <button type="submit" id="ingreso_captcha" class="btn fondoVioleta WhiteMedio"><b>Ingresar</b></button>
                                    </form>
                                </div>
                               
                            </form>  
                            </div>                        
                </div>                  
        </div> 
    </div>
</div>




<?php $this->stop() ?>
<?php $this->start('scripts') ?>
<script src="<?= lib('libs/js/js-captcha-master/dist/js/jCaptcha.min.js') ?>" type="text/javascript"></script>
<script src="<?= asset('js/auth/login.js') ?>" type="text/javascript"></script>
<?php $this->end() ?>