<?php
require 'src/vista/templates/header.php';
 ?>

<div class="container my-4">

  <h1 class="text-center"><?php echo $tipoFicha ?></h1>

  <div class="row m-3">
    <div class="col-md-8 mx-auto">

      <div class="card">

        <div class="card-body">
          <h4 class="card-title">Periodo ficha </h4>

          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

          <div class="card-group">
            <div class="card text-center">
              <div class="card-header">
                Fecha Inicio
              </div>
              <div class="card-body">
                25/48/2019
              </div>
            </div>
            <div class="card text-center">
              <div class="card-header">
                Fecha Fin
              </div>
              <div class="card-body">
                25/87/2956
              </div>
            </div>
          </div>


          <ul class="list-group list-group-flush">
           <li class="list-group-item">
             Fecha Ingreso:
             <span class="d-block">
               18/78/5652
             </span>
           </li>
           <li class="list-group-item">
             Fecha Modificacion:
             <span class="d-block">
               25/48/5215
             </span> </li>
         </ul>

        </div>

        <div class="card-footer bg-blue">
          <a href="#" class="card-link">Ver ficha</a>
          <a href="#" class="card-link">Llenar ficha</a>
        </div>

      </div>

    </div>
  </div>


</div>

<?php
require 'src/vista/templates/footer.php';
 ?>
