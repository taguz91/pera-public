
<?php
function formRespuestaUnica($act, $vp, $vr, $idActualizar, $idRespuesta,
$idPreguntaFicha, $idRespuestaFicha, $respuesta){ ?>

  <div class="custom-control custom-radio">
   <input onchange=<?php
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


<?php function formRespuestaLibreUnica($act, $ks , $kp, $id, $respuestas){ ?>

<?php if ($respuestas != null): ?>
  <?php foreach ($respuestas as $kr => $r): ?>

    <div class="form-group">
      <input class="form-control rlu-<?php echo $ks.'-'.$kp.$kr ; ?> "
      type="text" name="" value="<?php echo $r['alumno_fs_libre']; ?>"
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
    <input class="form-control rlu-<?php echo $ks.'-'.$kp.$kr ; ?> "
    type="text" name="" value="" id="<?php echo $id; ?>"
    onblur="<?php
    if($act){
      echo "valirdarTodosLlenos('rlu-$ks-$kp"."$kr')" ;
    }else{
      echo "";
    }
    ?>">
  </div>

<?php endif; ?>

<?php } ?>



<?php function formRespuestaLibreMultiple($act, $id, $respuestas){ ?>

<?php if ($respuestas != null): ?>

  <div class="form-horizontal form-res-mul" id="<?php echo $id; ?>">

  <?php foreach ($respuestas as $kr => $r): ?>
      <div class="form-row">
        <div class="col-12">
          <div class="form-group">
            <input id="reslibre-<?php echo $r['id_almn_respuesta_libre_fs']; ?>"
            class="form-control res-mul"
            onblur="<?php
            if($act){
              echo "actualizarRespuestaLibre('reslibre-".$r['id_almn_respuesta_libre_fs']."')";
            }else{
              echo "";
            }
            ?>"
            value="<?php echo $r['alumno_fs_libre']; ?>"
            type="text" name="">
          </div>
        </div>
      </div>

  <?php endforeach; ?>
  
  </div>

  <div class="row">
    <div class="col-2">
      <button class="btn btn-success btn-block btn-mas-txt" type="button" name="button">Mas</button>
    </div>
  </div>

<?php else: ?>

  <div class="form-horizontal form-res-mul" id="<?php echo $id; ?>" >
    <div class="form-row">
      <div class="col-12">
        <div class="form-group">
          <input id="<?php echo $id; ?>" class="form-control res-mul" type="text">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-2">
      <button class="btn btn-success btn-block btn-mas-txt" type="button">Mas</button>
    </div>
  </div>

  <script type="text/javascript">
    agregarVal('res-mul');
  </script>

<?php endif; ?>

<?php } ?>
