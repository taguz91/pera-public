<?php
$pagina  = 'Persona';
require 'src/admin/vista/templates/header.php';
 ?>


<div class="card shadown mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Personas  | Docentes / Alumnos
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
            <th scope="col">Pasaporte / Cedula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Celular</th>
            <th scope="col">Correo</th>
            <th scope="col">Enviar</th>
          </tr>
        </thead>

        <tbody>
          <?php
          if(isset($personas)){
            foreach ($personas as $p) {
              echo '<tr scope="row">';
              echo "<td>".
              $p['persona_identificacion'].
              "</td>";
              echo "<td>".
              $p['persona_primer_nombre'] . ' '
              .$p['persona_segundo_nombre'] . ' '
              .$p['persona_primer_apellido'] . ' '
              .$p['persona_segundo_apellido']
              ."</td>";
              echo "<td>".
              $p['persona_telefono'].
              "</td>";
              echo "<td>".
              $p['persona_celular'].
              "</td>";
              echo "<td>".
              $p['persona_correo'].
              "</td>";
              echo '<td> <a href="'.constant('URL').'personaficha/enviar?idpersona='.$p['id_persona'].'&correo='.$p['persona_correo'].'">Enviar</a> </td>';
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
