<?php
require 'src/vista/templates/header.php';
 ?>

<div class="container my-4">

  <h1 class="text-center"><?php echo $tipoFicha ?></h1>

<?php
for ($i=1; $i <= count($fichas); $i++) {
  //echo "Posicion: $i ".($i % 2)." <br>" ;
 ?>

<?php
  if($i % 2 != 0 OR $i == 0){
   echo ' <div class="row m-3">';
  }
  agregarFicha($fichas[$i-1], $i);
  if($i % 2 == 0 OR $i == count($fichas)){
    echo "</div>";
  }
 ?>

<?php } ?>

</div>

<?php function agregarFicha($f, $i){ ?>

  <div class="col-md-6 mx-auto my-2">

    <div class="card">

      <div class="card-body">
        <h3 class="card-title">
          <?php
          //echo $f['prd_lectivo_nombre'];
          echo $f->tipoFicha->tipo;
          ?>
        </h3>

        <h6 class="card-subtitle text-muted">
          <?php
          //echo $f['prd_lectivo_nombre'];
          echo $f->periodoLectivo;
          ?>
        </h6>

        <hr>

        <div class="card-group">
          <div class="card text-center">
            <div class="card-header">
              Fecha Inicio
            </div>
            <div class="card-body">
              <?php
              //echo $f['permiso_ingreso_fecha_inicio'];
              echo $f->personaFicha->permisoIngreso->fechaInicio;
              ?>
            </div>
          </div>
          <div class="card text-center">
            <div class="card-header">
              Fecha Fin
            </div>
            <div class="card-body">
              <?php
              //echo $f['permiso_ingreso_fecha_fin'];
              echo $f->personaFicha->permisoIngreso->fechaFin;
              ?>
            </div>
          </div>
        </div>

        <ul class="list-group list-group-flush">
         <li class="list-group-item">
           Fecha Ingreso:
           <span class="d-block">
             <?php
             //echo $f['persona_ficha_fecha_ingreso'];
             echo $f->personaFicha->fechaIngreso;
             ?>
           </span>
         </li>
         <li class="list-group-item">
           Fecha Modificacion:
           <span class="d-block">
             <?php
             //echo $f['persona_ficha_fecha_modificacion'];
             echo $f->personaFicha->fechaModificacion;
             ?>
           </span> </li>
       </ul>

      </div>

      <div class="card-footer">
        <a href="#" class="card-link">Ver ficha</a>
        <?php
        if($f->personaFicha->permisoIngreso->sePuedeIngresar()){
         ?>
         <button class="btn btn-link"
         type="button" data-toggle="collapse" data-target="#ingresar<?php echo $i; ?>">Ingresar</button>
         <div id="ingresar<?php echo $i; ?>" class="collapse">

            <form class="form-inline my-2" action="#" method="post">
              <div class="input-group w-100">
                <div class="input-group-prepend">
                  <span class="input-group-text">PS</span>
                </div>
                <input type="password" class="form-control" placeholder="Ingrese su contrasena:">
                <div class="input-group-append">
                  <button class="btn btn-success" type="button">Ingresar</button>
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
require 'src/vista/templates/footer.php';
 ?>
