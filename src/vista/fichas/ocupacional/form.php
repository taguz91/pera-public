<?php if (isset($act)): ?>
<!--Iniciamos las constantes-->
<script type="text/javascript">
  const URLACT = '<?php echo constant('URL')?>api/v1/ficha/guardar/?socioeconomica=asas';
  const URLGURDAR = '<?php echo constant('URL'); ?>api/v1/ficha/guardar';
</script>

<?php endif; ?>

<?php
//Cargamos las funciones para generar el formulario
require_once 'src/vista/fichas/socioeconomica/respuestas.php';
 ?>

<?php foreach ($secciones as $ks => $s) :?>
  <div class="row my-3 seccion">

    <div class="col-sm-11 col-lg-8 col-xl-7 pb-2 mx-auto ">

      <div class="bg-blue py-1">
        <h2 class="text-center text-white my-3 border-bottom pb-2">
          <?php echo $s['seccion_ficha_nombre']; ?>
        </h2>
      </div>

      <?php if (isset($s['preguntas'])): ?>

          <?php foreach ($s['preguntas'] as $vp => $p): ?>

          <div class="card m-3 mb-4 border-0 ">
            <div class="card-header-blue">
              <h5 class="card-title">
                <?php echo $p['pregunta_ficha']; ?>
              </h5>
              <h6 class="card-subtitle text-white">
                <?php echo $p['pregunta_ficha_ayuda']; ?>
              </h6>
              <?php if (isset($act) && $p['pregunta_ficha_tipo'] == 1): ?>
                <span class="badge badge-danger">Obligatoria</span>
              <?php endif; ?>
            </div>

            <div class="card-body">
              <!-- Respuestas de opcion multiple en la que solo se pueden seleccionar una -->
              <?php if (isset($p['respuestas']) && $p['pregunta_ficha_respuesta_tipo'] == 1): ?>

                <?php foreach ($p['respuestas'] as $kr => $r): ?>

                <?php endforeach; ?>

              <?php endif; ?>

              <!-- Respuestas de opcion multiple en la que se pueden seleccionar varias -->
              <?php if (isset($p['respuestas']) && $p['pregunta_ficha_respuesta_tipo'] == 2): ?>
                <?php foreach ($p['respuestas'] as $kr => $r): ?>

                <?php endforeach; ?>
              <?php endif; ?>

              <!-- Respuestas libres en las que solo se puede escribir una vez -->
              <?php if ($p['pregunta_ficha_respuesta_tipo'] == 3): ?>

              <?php endif; ?>

              <!-- Respuestas libres en las que se puede escribir mas de una vez -->
              <?php if ($p['pregunta_ficha_respuesta_tipo'] == 4): ?>

              <?php endif; ?>

              <!-- Respuestas de seleccion en la que se puede seleccionar una de un combo -->
              <?php if (isset($p['respuestas']) && $p['pregunta_ficha_respuesta_tipo'] == 5): ?>

              <?php endif; ?>

            </div>

          </div>

        <?php endforeach; ?>

      </div>

    </div>

  <?php endif; ?>

<?php endforeach; ?>


<script type="text/javascript">
  var vclick = 0;
</script>
