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
              <h5 class="card-title"><?php echo $p['pregunta_ficha']; ?></h5>
              <h6 class="card-subtitle text-white"><?php echo $p['pregunta_ficha_ayuda']; ?></h6>
            </div>

            <div class="card-body">

              <?php if (isset($p['respuestas'])): ?>

                <?php foreach ($p['respuestas'] as $vr => $r): ?>

                  <?php
                  if($p['pregunta_ficha_respuesta_tipo'] == 1){
                    formRespuestaUnica(
                      isset($act) ? $act : false,
                      $vp,
                      $vr,
                      $p['actualizar'],
                      $p['respuesta'],
                      $p['id_pregunta_ficha'],
                      $r['id_respuesta_ficha'], $r['respuesta_ficha']
                    );
                  }
                  ?>


                <?php endforeach; ?>

              <?php endif; ?>

              <?php
              if ($p['pregunta_ficha_respuesta_tipo'] == 3) {
                formRespuestaLibreUnica(
                  isset($act) ? $act : false,
                  $ks,
                  $ks,
                  $p['id_pregunta_ficha'],
                  isset($p['respuesta_libre']) ? $p['respuesta_libre'] : null
                );
              }

              if($p['pregunta_ficha_respuesta_tipo'] == 4){
                formRespuestaLibreMultiple(
                  isset($act) ? $act : false,
                  $p['id_pregunta_ficha'],
                  isset($p['respuesta_libre']) ? $p['respuesta_libre'] : null
                );
              }
              ?>

            </div>

          </div>

        <?php endforeach; ?>

      </div>

    </div>

  <?php endif; ?>

<?php endforeach; ?>


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
        <div class="col-10">
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

        <?php if ($kr == 0 && $act): ?>
          <div class="col-2">
            <button class="btn btn-success btn-block btn-mas-txt" type="button" name="button">Mas</button>
          </div>
        <?php endif; ?>
      </div>

  <?php endforeach; ?>

  </div>

<?php else: ?>

  <div class="form-horizontal form-res-mul" id="<?php echo $id; ?>" >
    <div class="form-row">
      <div class="col-10">
        <div class="form-group">
          <input id="<?php echo $id; ?>" class="form-control res-mul" type="text">
        </div>
      </div>
      <div class="col-2">
        <button class="btn btn-success btn-block btn-mas-txt" type="button">Mas</button>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    agregarVal('res-mul');
  </script>

<?php endif; ?>

<?php } ?>


<?php if (isset($act)):?>
  <script type="text/javascript">
    const URLACT = '<?php echo constant('URL').'api/v1/ficha/guardar/?socioeconomica=asas'?>';
    const URLGURDAR = '<?php echo constant('URL').'api/v1/ficha/guardar'; ?>';

    function actualizar(idActualizar, idRespuesta){
      console.log(URLACT);
      let data = new FormData();
      data.append('id_respuesta', idRespuesta);
      data.append('id_actualizar', idActualizar);
      fetch(URLACT, {
        method: 'POST',
        body: data
      })
      .then(res => res.json())
      .then(data => {
        console.log('Nice JOB: \n');
        console.log(data);
      })
      .catch(e => {
        console.log('Error: ' + e);
      })
    }
  </script>
<?php endif; ?>


<?php if (isset($act)): ?>

<script type="text/javascript">

  const BTNSMASTXT = document.querySelectorAll('.btn-mas-txt');
  var vclick = 0;
  BTNSMASTXT.forEach(b => {
    b.onclick = agregarOtroTxtResMul;
  });


  function agregarOtroTxtResMul(){
    vclick++;
    let FROMRESMUL = document.querySelectorAll('.form-res-mul');

    FROMRESMUL.forEach(f => {
      let D1 = document.createElement('div');
      let D2 = document.createElement('div');
      let D3 = document.createElement('div');
      let I = document.createElement('input');

      D1.classList.add('form-row', 'c'+vclick);
      D2.classList.add('col-10');
      D3.classList.add('form-group');
      I.classList.add('form-control', 'res-mul'+vclick);

      I.id = f.id;

      D3.appendChild(I);
      D2.appendChild(D3);
      D1.appendChild(D2);

      f.appendChild(D1);

    });
    agregarVal('res-mul'+vclick)
  }

  function agregarVal(clase){
    let I = document.querySelectorAll('.'+clase);
    I.forEach(i =>{
      i.onblur = function(){
        valirdarTodosLlenos(clase);
      }
    });
  }

  function valirdarTodosLlenos(clase){
    let I = document.querySelectorAll('.'+clase);
    let llenos = true;
    I.forEach(i => {
      if(i.value == ''){
        llenos = false;
      }
    });

    if(llenos){
      let URL = URLGURDAR + '?guardarlibre=true';
      console.log(URL);
      I.forEach(i => {

        let data = new FormData();
        data.append('id_pregunta_ficha', i.id);
        data.append('respuesta', i.value);

        console.log('ID: ' + i.id);
        console.log('Value: ' + i.value);

        fetch(URL, {
          method: 'POST',
          body: data
        })
        .then(res => res.json())
        .then(data => {
          console.log('Nice JOB: \n');
          console.log(data);
          if(data.statuscode == 200){
            i.onblur = '';
            i.disabled = true;
          }
        })
        .catch(e => {
          console.log('Error: ' + e);
        });

      });
    }else{
      console.log('No estan todos llenos aun no guardaremos!');
    }
  }

  function actualizarRespuestaLibre(id){
    let i = document.querySelector('#'+id);
    if(i != null){

      if(i.value != ''){
        let URL = URLGURDAR + '?actualizarlibre=true';
        console.log(URL);
        console.log('Valor id: ' + i.id);
        console.log('Valor: ' + i.value);

        let data = new FormData();
        data.append('id_almn_respuesta_fs', i.id);
        data.append('respuesta', i.value);

        fetch(URL, {
          method: 'POST',
          body: data
        })
        .then(res => res.json())
        .then(data => {
          console.log('Nice JOB: \n');
          console.log(data);
        })
        .catch(e => {
          console.log('Error: ' + e);
        });
      }

    }else{
      console.log('No tenemos el input '+id);
    }

  }

</script>

<?php endif; ?>
