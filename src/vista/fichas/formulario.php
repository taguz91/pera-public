<?php
require 'src/vista/templates/nav.php';
 ?>

<div class="container my-4">
  <h1 class="text-center my-3">Ingreso de Ficha</h1>
<?php foreach ($secciones as $s) {
  ?>
  <div class="row my-3">
    <div class="col-md-8 border rounded-lg mx-auto">
      <form class="" action="#" method="post">
        <h2 class="text-center my-2"><?php echo $s->nombre; ?></h2>

        <?php foreach ($s->preguntas as $vp => $p) {
          ?>


        <div class="card m-3">
          <div class="card-header">
            <h5 class="card-title"><?php echo $p->pregunta; ?></h5>
            <h6 class="card-subtitle text-muted"><?php echo $p->ayuda; ?></h6>
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
      <button type="submit" class="btn btn-primary btn-block mb-3">Guardar</button>

      </form>
    </div>
  </div>

<?php } ?>

</div>


<?php
require 'src/vista/templates/copy.php';
?>
