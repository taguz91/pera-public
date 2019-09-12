
<?php
function formRespuestaUnica($act, $vp, $vr, $idActualizar, $idRespuesta,
$idPreguntaFicha, $idRespuestaFicha, $respuesta){ ?>

  <div class="custom-control custom-radio">
   <input required onchange=<?php
   if($act){
     echo '"'."actualizar('" . $idActualizar . "', '". $idRespuestaFicha."')".'"';
   }else{
     echo '""';
   }
   ?> value="<?php echo $idRespuestaFicha; ?>"
   type="radio"
   class="custom-control-input"
   id="<?php echo $vp.$vr.$idRespuestaFicha; ?>"
   name="<?php echo $vp.'n'.$idPreguntaFicha; ?>"
   <?php if($idRespuestaFicha == $idRespuesta){ echo "checked";}?>>
  <label class="custom-control-label"
   for="<?php echo $vp.$vr.$idRespuestaFicha; ?>">
   <?php echo $respuesta; ?>
  </label>
 </div>

<?php } ?>


<?php function formRespuestaLibreUnica($act, $ks, $kp, $id, $respuestas, $tipo){ ?>

<?php if ($respuestas != null): ?>
  <?php foreach ($respuestas as $kr => $r): ?>

    <div class="form-group">
      <input required class="form-control rlu-<?php echo $ks.'-'.$kp.$kr ; ?> "
      type="<?php echo $tipo ?>"
      value="<?php echo $r['alumno_fs_libre']; ?>"
      id="reslibre-<?php echo $r['id_almn_respuesta_libre_fs']; ?>"
      onblur="<?php
      if($act){
        echo "actualizarRespuestaLibre('reslibre-".$r['id_almn_respuesta_libre_fs']."')" ;
      }else {
        echo "";
      }
      ?>">
    </div>

  <?php endforeach; ?>
<?php else: ?>

  <div class="form-group">
    <input required class="form-control rlu-<?php echo $ks.'-'.$kp ; ?> "
    type="<?php echo $tipo ?>" id="<?php echo $id; ?>"
    onblur="<?php
    if($act){
      echo "valirdarTodosLlenos('rlu-$ks-$kp"."')" ;
    }else{
      echo "";
    }
    ?>">
  </div>

<?php endif; ?>

<?php } ?>



<?php function formRespuestaLibreMultiple($act, $id, $respuestas, $tipo, $idS){ ?>

<?php if ($respuestas != null): ?>

  <div class="form-horizontal form-res-mul<?php echo $idS; ?> "
    data-tipo="<?php echo $tipo; ?>"
    id="<?php echo $id; ?>">

  <?php foreach ($respuestas as $kr => $r): ?>
      <div class="form-row">
        <div class="col-12">
          <div class="form-group">
            <input required id="reslibre-<?php echo $r['id_almn_respuesta_libre_fs']; ?>"
            class="form-control res-mul"
            onblur="<?php
            if($act){
              echo "actualizarRespuestaLibre('reslibre-".$r['id_almn_respuesta_libre_fs']."')";
            }else{
              echo "";
            }
            ?>"
            value="<?php echo $r['alumno_fs_libre']; ?>"
            type="<?php echo $tipo ?>">
          </div>
        </div>
      </div>

  <?php endforeach; ?>

  </div>

  <?php if ($act): ?>
    <div class="row">
      <div class="col-6 col-md-2">
        <button class="btn btn-success btn-block btn-mas-txt"
        onclick="<?php echo "agregarOtroTxtResMul('form-res-mul$idS')" ?>"
        type="button" name="button">Mas</button>
      </div>
    </div>
  <?php endif; ?>

<?php else: ?>

  <div class="form-horizontal form-res-mul<?php echo $idS; ?>"
    data-tipo="<?php echo $tipo; ?>"
    id="<?php echo $id; ?>" >
    <div class="form-row">
      <div class="col-12">
        <div class="form-group">
          <input required id="<?php echo $id; ?>"
          class="form-control res-mul<?php echo $idS; ?>"
          type="<?php echo $tipo ?>">
        </div>
      </div>
    </div>
  </div>

  <?php if ($act): ?>
    <div class="row">
      <div class="col-6 col-md-2">
        <button class="btn btn-success btn-block btn-mas-txt"
        onclick="<?php echo "agregarOtroTxtResMul('form-res-mul$idS')" ?>"
        type="button">Mas</button>
      </div>
    </div>

    <script type="text/javascript">
      agregarVal('res-mul<?php echo $idS ?>');
    </script>
  <?php endif; ?>

<?php endif; ?>

<?php } ?>
