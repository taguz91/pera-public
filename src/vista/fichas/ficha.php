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
  agregarFicha($fichas[$i-1]);
  if($i % 2 == 0 OR $i == count($fichas)){
    echo "</div>";
  }
 ?>

<?php } ?>

</div>

<?php function agregarFicha($f){ ?>

  <div class="col-md-6 mx-auto my-2">

    <div class="card">

      <div class="card-body">
        <h4 class="card-title">
          <?php echo $f['prd_lectivo_nombre'];
          ?>
        </h4>

        <div class="card-group">
          <div class="card text-center">
            <div class="card-header">
              Fecha Inicio
            </div>
            <div class="card-body">
              <?php
              echo $f['permiso_ingreso_fecha_inicio']
              ?>
            </div>
          </div>
          <div class="card text-center">
            <div class="card-header">
              Fecha Fin
            </div>
            <div class="card-body">
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
             echo $f['persona_ficha_fecha_ingreso']
             ?>
           </span>
         </li>
         <li class="list-group-item">
           Fecha Modificacion:
           <span class="d-block">
             <?php
             echo $f['persona_ficha_fecha_modificacion']
             ?>
           </span> </li>
       </ul>

      </div>

      <div class="card-footer bg-blue">
        <a href="#" class="card-link">Ver ficha</a>
        <a href="#" class="card-link">Llenar ficha</a>
      </div>

    </div>

  </div>
<?php } ?>

<?php
require 'src/vista/templates/footer.php';
 ?>
