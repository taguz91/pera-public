<?php
require 'src/vista/templates/nav.php';
//Para actualizar
$act = true;
 ?>
<?php if(isset($titulo)){ ?>
 <div class="border-top pt-3  ">
  <h1 class="text-muted text-center"><?php echo $titulo;?></h1>
 </div>
<?php } ?>

<div class="container my-4">

  <div class="row my-2">
    <div class="col-12 col-lg-8 mx-auto">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Indicaciones Generales</h3>
          <p class="card-text"> <strong>1.</strong> Sr./Srta. estudiante, LEA detenidamente el formulario y complemente TODOS los casilleros con la información solicitada.</p>
          <p class="card-text"> <strong>2.</strong> Deberá complementar la presente ficha con datos CLAROS y PRECISOS. La información personal proporcionada en este formulario, tendrá el carácter de información CONFIDENCIAL y será sujeta a VERIFICACIÓN. La comprobación en la FALSEDAD de la misma, determinará la ELIMINACIÓN de los futuros procesos a los que pueda solicitar o postular.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row my-2 sticky-top">

    <div class="alert alert-info alert-dismissible fade show mx-auto" role="alert">
      <h5 class="alert-heading">Importante!!!</h5>
      Las respuestas de opcion se guardan automaticamente.
      <hr>
      La seccion con preguntas libres sera guardada automaticamente,al estar llenas todos los campos.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

  </div>

  <div class="row">
    <form class="col" action="<?php echo constant('URL') ?>ficha/finalizar" method="post">

      <?php include cargarVista('fichas/socioeconomica/form.php'); ?>

    <div id="finfor" class="my-3">
      <div class="alert alert-info mb-3">
        Al terminar y enviar la ficha usted ya no podra modificarla, unicamente envie su ficha si esta lleno toda la informacion requerida.
        <hr>
        La ficha no sera enviada si no esta llena toda la informacion solicitada!
      </div>
      <button id="enviarficha" type="submit" class="btn btn-blue d-block w-50 mx-auto mb-3">Terminar y Enviar</button>
    </div>
    </form>
  </div>

<!--
  <div class="row" id="btnsnav">

    <div class="col-6 mx-auto" id="finant">
      <button id="anteriorsec" class="btn btn-info w-50 d-block mx-auto" type="button" name="button" onclick="clickAt()">Anterior</button>
    </div>

    <div class="col-6 mx-auto" id="finsig">
      <button id="seguientesec" class="btn btn-info w-50 d-block mx-auto" type="button" name="button" onclick="clickSg()">Siguiente</button>
    </div>

  </div>
-->

</div>

<?php
require 'src/vista/templates/copy.php';
?>
<!---
<script type="text/javascript" src="<?php //echo constant('URL'); ?>public/js/navficha.js"></script>
-->
