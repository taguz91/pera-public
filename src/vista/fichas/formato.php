<?php foreach ($secciones as $s) {
  ?>
  <div class="row my-3 seccion">

    <div class="col-md-8 pb-2 mx-auto ">
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
              <input type="radio" class="custom-control-input" id="<?php echo $vp.$vr; ?>" name="<?php echo $vp; ?>">
              <label class="custom-control-label" for="<?php echo $vp.$vr; ?>"><?php echo $r->respuesta; ?></label>
            </div>

           <?php } ?>

          </div>

        </div>
      <?php } ?>

    </div>

  </div>

<?php } ?>
