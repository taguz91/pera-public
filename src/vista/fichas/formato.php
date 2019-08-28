<?php foreach ($secciones as $s) {
  ?>
  <div class="row my-3 seccion">

    <div class="col-sm-11 col-lg-8 col-xl-7 pb-2 mx-auto ">
      <div class="bg-blue py-1">
        <h2 class="text-center text-white my-3 border-bottom pb-2"><?php echo $s->nombre; ?></h2>
      </div>

        <?php foreach ($s->preguntas as $vp => $p) {?>

        <div class="card m-3 mb-4 border-0 ">
          <div class="card-header-blue">
            <h5 class="card-title"><?php echo $p->pregunta; ?></h5>
            <h6 class="card-subtitle text-white"><?php echo $p->ayuda; ?></h6>
          </div>

          <div class="card-body">

            <?php
            foreach ($p->respuestas as $vr => $r) {
             ?>
             <div class="custom-control custom-radio">
              <input
              onchange="<?php echo isset($act) ? "actualizar('" . $p->r['actualizar'] . "', '". $r->id."')" : '' ?>"
              value="<?php echo $r->id; ?>" type="radio" class="custom-control-input"
              id="<?php echo $vp.$vr.$r->id; ?>" name="<?php echo $vp.'n'.$p->id; ?>"
              <?php if($r->id == $p->r['respuesta']){ echo "checked";}?>>
              <label class="custom-control-label" for="<?php echo $vp.$vr.$r->id; ?>"><?php echo $r->respuesta; ?></label>
            </div>

           <?php } ?>

          </div>

        </div>
      <?php } ?>

    </div>

  </div>

<?php } ?>


<?php if (isset($act)): ?>
  <script type="text/javascript">
    const URLACT = '<?php echo constant('URL').'api/v1/ficha/guardar/?socioeconomica=asas'?>';

    function act(id, id2){
      console.log('ID: '+id
      + '\nID2: '+id2 ,'\nURL: '+URLACT);
    }

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
