<?php
require 'src/vista/templates/nav.php';
$total = count($fichas);
 ?>

<div class="container my-4">

<?php if ($total == 0): ?>
  <div class="mx-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Mensaje!</h5>
        <p class="card-text">No cuenta con fichas actualmente, por favor debe pedir que le envien su ficha al correo.</p>
      </div>
    </div>
  </div>
  <?php else: ?>
    <div class="mx-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Como llenar la ficha</h5>
          <p class="card-text">Para llenar la ficha, debera revisar su correo electronico ahi puede encontrar la contrasena asignada para el ingreso de su ficha.</p>
        </div>
      </div>
    </div>
<?php endif; ?>

<?php
for ($i=1; $i <= $total; $i++) {
 ?>
<?php
  if($i % 2 != 0 OR $i == 0){
   echo ' <div class="row m-3">';
  }
  agregarFicha($fichas[$i-1], $i);
  if($i % 2 == 0 OR $i == $total){
    echo "</div>";
  }
 ?>

<?php } ?>

</div>

<?php function agregarFicha($f, $i){ ?>

  <div class="col-lg-6 col-md-10 mx-auto my-4 my-lg-0">

    <div class="card-ficha">

      <div class="card-head-ficha">
        <h3 class="card-title">
          <?php
          //echo $f['prd_lectivo_nombre'];
          echo $f['tipo_ficha'];
          ?>
        </h3>

        <h6 class="card-subtitle text-muted">
          <?php
          //echo $f['prd_lectivo_nombre'];
          echo $f['prd_lectivo_nombre'];
          ?>
        </h6>
      </div>

      <div class="card-body">

        <div class="card-group">
          <div class="card text-center">
            <div class="card-header-sm">
              Fecha Inicio
            </div>
            <div class="card-body-sm">
              <?php
              echo $f['permiso_ingreso_fecha_inicio'];
              ?>
            </div>
          </div>
          <div class="card text-center">
            <div class="card-header-sm">
              Fecha Fin
            </div>
            <div class="card-body-sm">
              <?php
              echo $f['permiso_ingreso_fecha_fin'];
              ?>
            </div>
          </div>
        </div>

        <ul class="list-group list-group-flush">
         <li class="list-group-item">
           Fecha Ingreso:
           <span class="d-block">
             <?php
             echo $f['persona_ficha_fecha_ingreso'];
             ?>
           </span>
         </li>
         <li class="list-group-item">
           Fecha Modificacion:
           <span class="d-block">
             <?php
             echo $f['persona_ficha_fecha_modificacion'];
             ?>
           </span> </li>
       </ul>

      </div>

      <div class="card-foot-ficha">
        <a href="<?php echo constant('URL'); ?>ficha/verficha/<?php echo $f['id_persona_ficha']; ?>" class="card-link">Ver ficha</a>
        <?php
        $fa = strtotime(strftime("%d-%m-%Y"));
        $ff = strtotime($f['permiso_ingreso_fecha_fin']);
        if($fa < $ff){
         ?>
         <button class="btn btn-link"
         type="button" data-toggle="collapse" data-target="#ingresar<?php echo $i; ?>">Ingresar</button>
         <div id="ingresar<?php echo $i; ?>" class="collapse">

            <form class="form-inline my-2" action="<?php echo constant('URL'); ?>ficha/ingresar/<?php echo $f['id_persona_ficha']; ?>" method="post">
              <div class="input-group w-100">
                <div class="input-group-prepend">
                  <span class="input-group-text">PS</span>
                </div>
                <input type="password" class="form-control" placeholder="Ingrese su contrasena:">
                <div class="input-group-append">
                  <button class="btn btn-success" type="submit">Ingresar</button>
                </div>
              </div>
            </form>
            <a href="#" class="badge">Solicitar contrasena</a>
            <a href="#" class="badge">Ayuda</a>

         </div>

        <?php } ?>
      </div>

    </div>

  </div>
<?php } ?>

<?php
require 'src/vista/templates/copy.php';
 ?>
