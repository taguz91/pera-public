
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

      <div class="input-group">

        <input required class="form-control rlu-<?php echo $ks.'-'.$kp.$kr ; ?> "
        type="<?php echo getTipoCampo($tipo, $r['alumno_fs_libre']); ?>"
        value="<?php echo $r['alumno_fs_libre']; ?>"
        id="reslibre-<?php echo $r['id_almn_respuesta_libre_fs']; ?>"
        onblur="<?php
        if($act){
          echo "actualizarRespuestaLibre('reslibre-".$r['id_almn_respuesta_libre_fs']."')" ;
        }?>">

        <?php if ($act): ?>
          <div class="input-group-append">
            <button class="btn btn-outline-primary  btn-na"
            type="button" value="reslibre-<?php
            echo $r['id_almn_respuesta_libre_fs']; ?>">
            NA
            </button>
          </div>
        <?php endif; ?>

      </div>


    </div>

  <?php endforeach; ?>
<?php else: ?>

  <div class="form-group">

    <div class="input-group ">

      <input required class="form-control rlu-<?php echo $ks.'-'.$kp ; ?> "
      type="<?php echo $tipo ?>" id="<?php echo 'rsc--'.$id; ?>"
      onblur="<?php
      if($act){
        echo "valirdarTodosLlenos('rlu-$ks-$kp"."')" ;
      }else{
        echo "";
      }
      ?>">

      <?php if ($act): ?>
        <div class="input-group-append">
          <button class="btn btn-outline-primary btn-na"
          type="button" value="<?php echo 'rsc--'.$id; ?>">
          NA
          </button>
        </div>
      <?php endif; ?>

    </div>

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

            <div class="input-group">
              <input required id="reslibre-<?php echo $r['id_almn_respuesta_libre_fs']; ?>"
              class="form-control res-mul"
              onblur="<?php
              if($act){
                echo "actualizarRespuestaLibre('reslibre-".$r['id_almn_respuesta_libre_fs']."')";
              }?>"
              value="<?php echo $r['alumno_fs_libre']; ?>"
              type="<?php echo getTipoCampo($tipo, $r['alumno_fs_libre']); ?>">


              <?php if ($act): ?>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary btn-na" type="button"
                  value="reslibre-<?php echo $r['id_almn_respuesta_libre_fs']; ?>">
                    NA
                  </button>
                </div>
              <?php endif; ?>

            </div>

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

          <div class="input-group">
            <input required id="<?php echo 'rsc--'.$id; ?>"
            class="form-control res-mul<?php echo $idS; ?>"
            type="<?php echo $tipo ?>">

            <?php if ($act): ?>
              <div class="input-group-append">
                <button class="btn btn-outline-primary btn-na"
                type="button"
                value="<?php echo 'rsc--'.$id; ?>">
                NA
                </button>
              </div>
            <?php endif; ?>

          </div>

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

<?php function formRespuestaSeleccion($act, $id, $opciones, $respuestas, $idS) { ?>

  <div class="form-horizontal form-res-mul<?php echo $idS; ?>"
    data-tipo="select"
    id="<?php echo $id; ?>">

  <?php if ($respuestas != null && $opciones != null): ?>

    <?php
      foreach ($respuestas as $r) {
        llenarCmbFormFS(
          $opciones,
          $r['alumno_fs_libre'],
          $id,
          $idS,
          $r['id_almn_respuesta_libre_fs']
        );
      }
    ?>
  <?php else: ?>

    <?php if ($opciones != null): ?>
      <?php
        llenarCmbFormFS(
          $opciones,
          "",
          $id,
          $idS,
          ""
        );
      ?>
    <?php endif; ?>

  <?php endif; ?>

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
  <?php endif;?>


<?php } ?>


<?php function llenarCmbFormFS($opciones, $selec, $id, $idS, $idA){ ?>

  <div class="form-row">
    <div class="col-12">
      <div class="form-group">

        <select
        id="<?php
          if($idA != ""){
            echo "reslibre-$idA";
          } else{
            echo $id;
          }
        ?>"
        class="form-control <?php
        if ($selec == "") {
          echo 'res-mul'.$idS;
        }
        ?>"
        onblur="<?php
        if($idA != ""){
          echo "actualizarRespuestaLibre('reslibre-".$idA."')";
        }
        ?>"
        name="select-<?php echo $idS ?> ">
          <option value="">Seleccione</option>
          <?php foreach ($opciones as $o): ?>
            <option
            class="select-<?php echo $id; ?>"
            value="<?php echo $o['respuesta_ficha']; ?>"
              <?php if ($selec == $o['respuesta_ficha']): ?>
                <?php echo " selected " ?>
              <?php endif; ?>
              >
              <?php echo $o['respuesta_ficha']; ?></option>
          <?php endforeach; ?>

        </select>

      </div>
    </div>
  </div>

<?php } ?>
