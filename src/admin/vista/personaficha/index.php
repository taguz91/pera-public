<?php
$pagina = 'Fichas Enviadas';
require 'src/admin/vista/templates/header.php';
 ?>


<div class="card shadown mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Todas las fichas enviadas
        </h6>
      </div>

      <div class="col-4 col-lg-2">
        <a href="<?php echo constant('URL') ?>miad/correo/masivo" class="btn btn-success btn-block">Ingresar </a>
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
            <th scope="col">IDPermiso</th>
            <th scope="col">Nombre Persona</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Modificación</th>
            <th scope="col">Reenviar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>

        <tbody>
          <?php
          if(isset($personaFichas)){
            foreach ($personaFichas as $pf) {
              echo '<tr scope="row">';
              echo "<td>".$pf['id_persona_ficha']."</td>";
              echo "<td>".$pf['id_permiso_ingreso_ficha']."</td>";
              echo "<td>".$pf['persona_primer_nombre']."  ".$pf['persona_primer_apellido']."</td>";
              echo "<td>".$pf['persona_ficha_fecha_ingreso']."</td>";
              echo "<td>".$pf['persona_ficha_fecha_modificacion']."</td>";
              echo '<td> <a href="'.constant('URL').'miad/correo/reenviar?id='.$pf['id_persona_ficha'].'">Reenviar</a> </td>';
              echo '<td> <a href="'.constant('URL').'miad/correo/eliminar?id='.$pf['id_persona_ficha'].'">Eliminar</a> </td>';
              echo "</tr>";
            }
          }else{
            Errores::errorBuscar("No encontramos las fichas de las personas");
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
