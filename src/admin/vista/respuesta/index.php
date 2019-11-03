<?php
$pagina = 'Respuestas';
require 'src/admin/vista/templates/header.php';
 ?>

 <div class="card shadown mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Numero de respuestas por permiso ingreso fichas.
        </h6>
      </div>
    </div>

    <?php if (isset($mensaje)): ?>
      <div class="row">
        <div class="col-10 mx-auto">
          <div class="alert alert-info my-2 text-center alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>

    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Periodo </th>
              <th scope="col">Ficha</th>
              <th scope="col">Numero de fichas</th>
              <th scope="col">Numero de respuestas</th>
              <th scope="col">Reporte</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(!isset($res['error'])){
              foreach ($res as $r) {
                echo '<tr scope="row">';
                echo "<td>".$r['id_permiso_ingreso_ficha']."</td>";
                echo "<td>".$r['prd_lectivo_nombre']."</td>";
                echo "<td>".$r['tipo_ficha']."</td>";
                echo "<td>".$r['num_personas']."</td>";
                echo "<td>".$r['num_terminados']."</td>";
                echo '<td> <a target="_blank"  href="'.constant('URL').'miad/respuesta/reporte?idPermiso='.$r['id_permiso_ingreso_ficha'].'">Ver</a> </td>';
              }
            }else{
              Errores::errorBuscar("No encontramos tipos de fichas");
            }
             ?>
          </tbody>
        </table>
      </div>

    </div>
</div>


<?php
require 'src/admin/vista/templates/footer.php';
 ?>
